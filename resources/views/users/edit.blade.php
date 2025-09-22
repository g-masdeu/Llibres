@extends('layouts.master')
@section('title','Editar Usuari')
@section('content')

<div class="container my-5">

    <div class="card-header text-center">
        👤 Editar Usuari
    </div>    

    <!-- Formulari per editar un usuari -->
    <div class="card-body p-2">
        <form action="route{{'users.update', $user->id}}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name", id="name", class="form-control" value="{{old('name', $user->name)}}">
            </div>

            <!-- Contrasenya -->
            <div class="form-group">
                <label for="password">Contrasenya</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Deixa en blanc si no vols canviar-la">
            </div>

            <!-- Correu -->
            <div class="form-group">
                <label for="email">Corrreu</label>
                <input type="email" name="email" id="email" class="form-control" value="{{old('email', $user->email)}}">
            </div>

            <!-- Data de naixament -->
            <div class="form-group">
                <label for="birth_date">Data de naixament</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{old('birth_date', $user->birth_date)}}">
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                    Editar Usuari
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
