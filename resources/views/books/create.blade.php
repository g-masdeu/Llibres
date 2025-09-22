@extends('layouts.master')
@section('title', 'Nou llibre')
@section('content')

<div class="min-vh-100 py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <!-- Header Card -->
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-lg mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-book text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h1 class="text-white fw-bold mb-0">Afegir Nou Llibre</h1>
                    <p class="text-white-50">Completa la informació del llibre</p>
                </div>

                <!-- Main Form Card -->
                <div class="card border-0 shadow-xl" style="border-radius: 20px; backdrop-filter: blur(10px);">
                    <div class="card-body p-5">
                        <form action="{{ route('books.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="row g-4">
                                <!-- Títol -->
                                <div class="col-12">
                                    <label for="title" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-heading me-2 text-primary"></i>Títol del Llibre
                                    </label>
                                    <input type="text" name="title" id="title" 
                                           class="form-control form-control-lg border-0 shadow-sm" 
                                           style="border-radius: 15px; background-color: #f8f9fa;"
                                           placeholder="Introdueix el títol del llibre" required>
                                    <div class="invalid-feedback">
                                        Si us plau, introdueix un títol vàlid.
                                    </div>
                                </div>

                                <!-- Autor -->
                                <div class="col-md-6">
                                    <label for="author" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-user-edit me-2 text-primary"></i>Autor
                                    </label>
                                    <input type="text" name="author" id="author" 
                                           class="form-control border-0 shadow-sm" 
                                           style="border-radius: 15px; background-color: #f8f9fa;"
                                           placeholder="Nom de l'autor" required>
                                    <div class="invalid-feedback">
                                        Si us plau, introdueix l'autor.
                                    </div>
                                </div>

                                <!-- Categoria -->
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-tags me-2 text-primary"></i>Categoria
                                    </label>
                                    <select name="category_id" id="category_id" 
                                            class="form-select border-0 shadow-sm" 
                                            style="border-radius: 15px; background-color: #f8f9fa;" required>
                                        <option value="">Selecciona una categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Si us plau, selecciona una categoria.
                                    </div>
                                </div>

                                <!-- Resum -->
                                <div class="col-12">
                                    <label for="summary" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-align-left me-2 text-primary"></i>Resum
                                    </label>
                                    <textarea name="summary" id="summary" rows="4" 
                                              class="form-control border-0 shadow-sm" 
                                              style="border-radius: 15px; background-color: #f8f9fa; resize: vertical;"
                                              placeholder="Escriu un breu resum del llibre..." required></textarea>
                                    <div class="invalid-feedback">
                                        Si us plau, introdueix un resum.
                                    </div>
                                </div>

                                <!-- Data i Preu -->
                                <div class="col-md-6">
                                    <label for="publication_date" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-calendar-alt me-2 text-primary"></i>Data de Publicació
                                    </label>
                                    <input type="date" name="publication_date" id="publication_date" 
                                           class="form-control border-0 shadow-sm" 
                                           style="border-radius: 15px; background-color: #f8f9fa;" required>
                                    <div class="invalid-feedback">
                                        Si us plau, selecciona una data vàlida.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-euro-sign me-2 text-primary"></i>Preu (€)
                                    </label>
                                    <input type="number" min="0" max="1000000" step="0.01" 
                                           name="price" id="price" 
                                           class="form-control border-0 shadow-sm" 
                                           style="border-radius: 15px; background-color: #f8f9fa;"
                                           placeholder="0.00" required>
                                    <div class="invalid-feedback">
                                        Si us plau, introdueix un preu vàlid.
                                    </div>
                                </div>

                                <!-- Edat mínima -->
                                <div class="col-md-6">
                                    <label for="min_age" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-child me-2 text-primary"></i>Edat Mínima
                                    </label>
                                    <input type="number" min="0" max="99" name="min_age" id="min_age" 
                                           class="form-control border-0 shadow-sm" 
                                           style="border-radius: 15px; background-color: #f8f9fa;"
                                           placeholder="0" required onwheel="this.blur()">
                                    <div class="invalid-feedback">
                                        Si us plau, introdueix una edat vàlida.
                                    </div>
                                </div>

                                <!-- Imatge -->
                                <div class="col-md-6">
                                    <label for="image" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-image me-2 text-primary"></i>URL de la Imatge
                                    </label>
                                    <input type="url" name="image" id="image" 
                                           class="form-control border-0 shadow-sm" 
                                           style="border-radius: 15px; background-color: #f8f9fa;"
                                           placeholder="https://exemple.com/imatge.jpg" required>
                                    <div class="invalid-feedback">
                                        Si us plau, introdueix una URL vàlida.
                                    </div>
                                </div>
                            </div>

                            <!-- Error Messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger border-0 shadow-sm mt-4" style="border-radius: 15px;">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>S'han trobat els següents errors:</strong>
                                    </div>
                                    <ul class="mb-0 ps-4">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5 py-3 border-0 shadow" 
                                        style="border-radius: 50px; background: linear-gradient(45deg, #667eea, #764ba2); transition: all 0.3s ease;">
                                    <i class="fas fa-plus me-2"></i>Crear Llibre
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('books.index') }}" class="btn btn-outline-light btn-lg px-4 py-2" 
                       style="border-radius: 50px; backdrop-filter: blur(10px);">
                        <i class="fas fa-arrow-left me-2"></i>Tornar al Catàleg
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4) !important;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background-color: #ffffff !important;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .form-control, .form-select {
        transition: all 0.3s ease;
    }
    
    .form-control:hover, .form-select:hover {
        background-color: #ffffff !important;
        transform: translateY(-1px);
    }
</style>

@endsection