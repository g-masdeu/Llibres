@extends('layouts.master')
@section('title', 'Mostrar')
@section('content')

    <!-- Age Check -->
    @php
        use Carbon\Carbon;
        $user = auth()->user();
        $age = $user ? Carbon::parse($user->birth_date)->age : null;
    @endphp

    <div class="min-vh-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <!-- Age Restriction Warning -->
        @if ($age !== null && $age < $book->min_age)
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-xl text-center"
                            style="border-radius: 20px; backdrop-filter: blur(10px);">
                            <div class="card-body p-5">
                                <div class="mb-4">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-20 rounded-circle mb-3"
                                        style="width: 80px; height: 80px;">
                                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 2rem;"></i>
                                    </div>
                                    <h3 class="text-dark fw-bold">Accés Restringit</h3>
                                    <p class="text-muted fs-5">No tens l'edat mínima per veure aquest llibre.</p>
                                    <div class="alert alert-warning border-0 mt-4" style="border-radius: 15px;">
                                        <strong>Edat requerida:</strong> {{ $book->min_age }} anys o més
                                    </div>
                                </div>
                                <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg px-5 py-3"
                                    style="border-radius: 50px; background: linear-gradient(45deg, #667eea, #764ba2);">
                                    <i class="fas fa-arrow-left me-2"></i>Tornar al Catàleg
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container py-5">
                <!-- Book Details Section -->
                <div class="row mb-5">
                    <!-- Book Image -->
                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 shadow-xl h-100"
                            style="border-radius: 20px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                            <div class="card-body p-4 text-center">
                                <img src="{{ $book->image }}" alt="{{ $book->title }}"
                                    class="img-fluid rounded-3 shadow-lg"
                                    style="max-height: 400px; object-fit: cover; transition: transform 0.3s ease;">

                                <!-- Quick Stats -->
                                <div class="row mt-4 g-2">
                                    <div class="col-6">
                                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                            <i class="fas fa-euro-sign text-primary mb-2"></i>
                                            <div class="fw-bold text-primary">{{ number_format($book->price, 2) }}€</div>
                                            <small class="text-muted">Preu</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                            <i class="fas fa-child text-warning mb-2"></i>
                                            <div class="fw-bold text-warning">{{ $book->min_age }}+</div>
                                            <small class="text-muted">Edat mín.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Information -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-xl h-100"
                            style="border-radius: 20px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                            <div class="card-body p-5">
                                <!-- Title and Category -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge px-3 py-2 me-3"
                                            style="background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 50px;">
                                            <i class="fas fa-tag me-1"></i>{{ $book->category->name }}
                                        </span>
                                    </div>
                                    <h1 class="display-5 fw-bold text-dark mb-3">{{ $book->title }}</h1>
                                    <h5 class="text-muted mb-4">
                                        <i class="fas fa-user-edit me-2"></i>{{ $book->author }}
                                    </h5>
                                </div>

                                <!-- Book Details -->
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                                <i class="fas fa-calendar-alt text-info"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Data de publicació</small>
                                                <strong>{{ Carbon::parse($book->publication_date)->format('d/m/Y') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                                <i class="fas fa-euro-sign text-success"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Preu</small>
                                                <strong>{{ number_format($book->price, 2) }} €</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summary -->
                                <div class="mb-4">
                                    <h6 class="fw-bold text-dark mb-3">
                                        <i class="fas fa-align-left me-2 text-primary"></i>Resum
                                    </h6>
                                    <p class="text-muted lh-lg">{{ $book->summary }}</p>
                                </div>

                                <!-- Admin Actions -->
                                @if (auth()->check() && auth()->user()->is_admin)
                                    <div class="alert alert-light border-0 mb-4" style="border-radius: 15px;">
                                        <h6 class="fw-bold mb-3">
                                            <i class="fas fa-cog me-2"></i>Opcions d'administrador
                                        </h6>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ url('/books/edit/' . $book->id) }}"
                                                class="btn btn-warning px-4 py-2" style="border-radius: 50px;">
                                                <i class="fas fa-edit me-2"></i>Editar llibre
                                            </a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Estàs segur que vols eliminar aquest llibre?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger px-4 py-2"
                                                    style="border-radius: 50px;">
                                                    <i class="fas fa-trash me-2"></i>Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="{{ url('/books') }}" class="btn btn-outline-primary btn-lg px-4 py-3"
                                        style="border-radius: 50px;">
                                        <i class="fas fa-arrow-left me-2"></i>Tornar al catàleg
                                    </a>
                                    <a href="{{ route('reviews.create', $book->id) }}"
                                        class="btn btn-primary btn-lg px-4 py-3"
                                        style="border-radius: 50px; background: linear-gradient(45deg, #667eea, #764ba2);">
                                        <i class="fas fa-star me-2"></i>Escriure ressenya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="card border-0 shadow-xl"
                    style="border-radius: 20px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                    <div class="card-body p-5">
                        <h3 class="mb-4 fw-bold text-dark text-center">Valoracions del llibre</h3>

                        @if ($book->reviews->count())
                            @php
                                $averageRating = $book->reviews->avg('rating');
                                $totalReviews = $book->reviews->count();
                            @endphp

                            <!-- Mitjana valoració -->
                            <div class="text-center mb-5"
                                aria-label="Mitjana de valoració: {{ number_format($averageRating, 1) }} sobre 10">
                                @for ($i = 1; $i <= 10; $i++)
                                    @if ($i <= round($averageRating))
                                        <span class="text-warning fs-3">&#9733;</span>
                                    @else
                                        <span class="text-muted fs-3">&#9734;</span>
                                    @endif
                                @endfor
                                <p class="mt-3 text-muted fw-semibold">
                                    Mitjana: {{ number_format($averageRating, 1) }}/10 ({{ $totalReviews }}
                                    ressenya{{ $totalReviews > 1 ? 's' : '' }})
                                </p>
                            </div>

                            <div class="row g-4 justify-content-center">
                                @foreach ($book->reviews as $review)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card shadow-sm h-100"
                                            style="border-radius: 20px; background: rgba(255,255,255,0.9); backdrop-filter: blur(5px);">
                                            <div class="card-body">
                                                @if (auth()->check() && auth()->user()->is_admin)
                                                    <div class="text-end mb-2">
                                                        <form action="{{ route('reviews.destroy', [$review->id]) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Segur que vols eliminar aquesta ressenya?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                                <h5 class="card-title fw-bold text-primary">{{ $review->user->name }}</h5>
                                                <p class="mb-1">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        @if ($i <= $review->rating)
                                                            <span class="text-warning">&#9733;</span>
                                                        @else
                                                            <span class="text-muted">&#9734;</span>
                                                        @endif
                                                    @endfor
                                                </p>
                                                <p class="card-text text-secondary">{{ $review->review }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-muted fst-italic py-4">Aquest llibre encara no té ressenyes.</p>
                        @endif
                    </div>
                </div>
        @endif
    </div>
@endsection
