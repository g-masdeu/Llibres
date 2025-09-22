@extends('layouts.master')

@section('title', 'Eliminar Usuari')

@section('content')
<div class="row" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <div class="card-header text-center">
                Eliminar Usuari
            </div>
            <div class="card-body" style="padding:30px">

                {{-- Formulario con un select para elegir la categoría --}}
                <form action="{{ route('users.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    {{-- Select para elegir la categoría --}}
                    <div class="form-group">
                        <label for="user_id">Usuari</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="" disabled selected>Selecciona un usuari a eliminar</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botón para eliminar la categoría --}}
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger" style="padding:8px 100px;margin-top:25px;">
                            Eliminar Usuari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
