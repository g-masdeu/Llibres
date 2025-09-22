@extends('layouts.master')

@section('title', 'Eliminar Categoria')

@section('content')
<div class="row" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <div class="card-header text-center">
                Eliminar Categoria
            </div>
            <div class="card-body" style="padding:30px">

                {{-- Formulario con un select para elegir la categoría --}}
                <form action="{{ route('categories.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    {{-- Select para elegir la categoría --}}
                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="" disabled selected>Selecciona la categoria a eliminar</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botón para eliminar la categoría --}}
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger" style="padding:8px 100px;margin-top:25px;">
                            Eliminar Categoria
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
