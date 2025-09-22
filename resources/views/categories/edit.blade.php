@extends('layouts.master')
@section('title', 'Editar Categoria')
@section('content')

<div class="container my-5">
    <div class="col-12 col-sm-5 offset-sm-3">

        <!-- Títol -->
        <div class="card-header text-center">
            Editar Categoria
        </div>

        <!-- Formulari per editar la categoria -->
        <div class="card-body p-2">
            <form action="route{{'categories.update'}}" method="POST">

                @csrf
                @method('PUT')

                <!-- Nom -->
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name', $category->name)}}">
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                        Editar Categoria
                    </button>
                </div>


            </form>

        </div>

    </div>
    
</div>
@endsection
