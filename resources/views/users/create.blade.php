@extends('layouts.master')
@section('title', 'Crear usuari')
@section('content')

<div class="container my-5">
    <div class="card-header text-center">
        👤 Nou Usuari
    </div>

    <div class="card-body p-2">

        <!-- Formulari per afegir un usuari nou -->
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <!-- Nom -->
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Correu -->
            <div class="form-group">
                <label for="email">Correu</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <!-- Contrasneya -->
            <div class="form-group">
                <label for="password">Contrasenya</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Confirmar contrasenya -->
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contrasenya</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <!-- Data naixament -->
            <div class="form-group">
                <label for="birth_date">Data Naixament</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" required>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                    Crear Usuari
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
