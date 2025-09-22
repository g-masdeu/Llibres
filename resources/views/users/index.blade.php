@extends('layouts.master')
@section('title', 'usuaris')
@section('content')

<div class="container my-5">

    <h1 class="text-center mb-2">Llista d'Usuaris</h1>

    <table class="table table-bordered" style="with:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Correu</th>
                <th>Contrasenya</th>
                <th>Data Naixament</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->password}}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') }} 
                        ({{ \Carbon\Carbon::parse($user->birth_date)->age }} anys)
                    </td>                    
                    <td>
                        <a href="{{route('users.edit', $user->id)}}" 
                        class="btn btn-warning d-inline">Editar</a>                    
                    </td>
                    <td>
                            <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger d-inline">
                                    Eliminar
                                </button>
                            </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
