@extends('layouts.master')
@section('title', 'Categories')
@section('content')

<div class="container my-5">
    <h1 class="text-center mb-2">Llista de Categories</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-warning d-inline">Editar</a>
                    </td>
                    <td>
                        <form action="{{route('categories.destroy', $category->id)}}" method="POST">
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
