@extends('layouts.welcome')
@section('title', 'Benvingut')
@section('content')

<div class="container my-5">
    <!-- Logotip i Títol -->
    <div class="text-center mb-4">
        <span style="font-size: 3rem" class="mb-3">📚</span>
        <h1>Benvingut a Ressenya Llibres</h1>
        <p class="lead">Descobreix, comparteix i llegeix opinions sobre els teus llibres preferits.</p>
    </div>

    <div class="row justify-content-center">
        <!-- Formulari d'inici de sessió -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Inicia sessió</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Correu electrònic</label>
                            <input type="email" name="email" id="email" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contrasenya</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Recorda'm</label>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('password.request') }}">Has oblidat la contrasenya?</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <p>Encara no tens compte? <a href="{{ route('register') }}">Registra't aquí</a>.</p>
            </div>
        </div>
    </div>
</div>

@endsection
