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
                                <div class="row mt-4 g-3">
                                    <div class="col-12">
                                        <div class="stat-card age-card">
                                            <div class="stat-icon">
                                                <i class="fas fa-user-shield"></i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="stat-label">Edat mínima</div>
                                                <div class="stat-value">{{ $book->min_age }}<span class="age-plus"> anys o més</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <style>
                                    .stat-card {
                                        position: relative;
                                        padding: 1.5rem;
                                        border-radius: 18px;
                                        overflow: hidden;
                                        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
                                        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                                        cursor: default;
                                        height: 100%;
                                    }
                                    
                                    .price-card {
                                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                        color: white;
                                    }
                                    
                                    .age-card {
                                        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                                        color: white;
                                    }
                                    
                                    .stat-card:hover {
                                        transform: translateY(-5px) scale(1.02);
                                        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
                                    }
                                    
                                    .stat-card::before {
                                        content: '';
                                        position: absolute;
                                        top: -50%;
                                        right: -50%;
                                        width: 200%;
                                        height: 200%;
                                        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
                                        transition: all 0.6s ease;
                                        opacity: 0;
                                    }
                                    
                                    .stat-card:hover::before {
                                        opacity: 1;
                                        top: -30%;
                                        right: -30%;
                                    }
                                    
                                    .stat-icon {
                                        font-size: 2rem;
                                        margin-bottom: 0.8rem;
                                        opacity: 0.9;
                                        animation: float 3s ease-in-out infinite;
                                    }
                                    
                                    @keyframes float {
                                        0%, 100% { transform: translateY(0px); }
                                        50% { transform: translateY(-8px); }
                                    }
                                    
                                    .stat-content {
                                        position: relative;
                                        z-index: 1;
                                    }
                                    
                                    .stat-label {
                                        font-size: 0.75rem;
                                        text-transform: uppercase;
                                        letter-spacing: 1.2px;
                                        font-weight: 600;
                                        margin-bottom: 0.5rem;
                                        opacity: 0.95;
                                    }
                                    
                                    .stat-value {
                                        font-size: 2rem;
                                        font-weight: 800;
                                        line-height: 1;
                                        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
                                    }
                                    
                                    .currency, .age-plus {
                                        font-size: 1.2rem;
                                        font-weight: 600;
                                        margin-left: 0.2rem;
                                    }
                                    
                                    /* Responsive */
                                    @media (max-width: 768px) {
                                        .stat-card {
                                            padding: 1.2rem;
                                        }
                                        
                                        .stat-icon {
                                            font-size: 1.5rem;
                                        }
                                        
                                        .stat-value {
                                            font-size: 1.6rem;
                                        }
                                        
                                        .currency, .age-plus {
                                            font-size: 1rem;
                                        }
                                    }
                                </style>
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
