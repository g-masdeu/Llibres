@extends('layouts.master')

@section('title', 'Nova Categoria')

@section('content')
<div class="row" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <div class="card-header text-center">
                Nova Categoria
            </div>
            <div class="card-body" style="padding:30px">

                {{-- Formulario para crear una nueva categoría --}} 
                <form action="{{ route('categories.store') }}" method="POST">
                    {{-- Protección CSRF --}}
                    @csrf

                    {{-- Input para el nombre de la categoría --}}
                    <div class="form-group">
                        <label for="name">Nom de la categoria</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    {{-- Botón para crear la categoría --}}
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                            Crear Categoria
                        </button>
                    </div>

                </form> 
            </div>
        </div>
    </div>
</div>
@endsection
