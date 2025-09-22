@extends('layouts.master')
@section('title', 'Eliminar llibres')
@section('content')

<div class="min-vh-100" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);">
    <div class="container py-5">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-lg mb-3" style="width: 80px; height: 80px;">
                <i class="fas fa-trash-alt text-danger" style="font-size: 2rem;"></i>
            </div>
            <h1 class="text-white fw-bold mb-2">Gestió d'Eliminació</h1>
            <p class="text-white-50 fs-5">Selecciona els llibres que vols eliminar</p>
            
            @isset($category)
                <div class="alert alert-light border-0 shadow-sm d-inline-block mt-3" style="border-radius: 50px;">
                    <i class="fas fa-filter me-2 text-primary"></i>
                    <strong>Categoria filtrada:</strong> {{ $category->name }}
                </div>
            @endisset
        </div>

        <!-- Warning Alert -->
        <div class="alert alert-warning border-0 shadow-lg mb-5" style="border-radius: 20px; backdrop-filter: blur(10px);">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="alert-heading fw-bold mb-2">Atenció: Acció Irreversible</h5>
                    <p class="mb-0">Una vegada eliminats, els llibres i totes les seves valoracions es perdran permanentment. Assegura't de la teva decisió abans de procedir.</p>
                </div>
            </div>
        </div>

        <!-- Books Grid -->
        @if($books->count() > 0)
            <div class="row g-4 mb-5">
                @foreach($books as $book)
                    @if (!isset($category) || $book->category_id == $category->id)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100 border-0 shadow-lg book-card" style="border-radius: 20px; transition: all 0.3s ease;">
                                <!-- Book Image -->
                                <div class="position-relative overflow-hidden" style="border-radius: 20px 20px 0 0;">
                                    <img src="{{ $book->image }}" alt="{{ $book->title }}" 
                                         class="card-img-top" 
                                         style="height: 280px; object-fit: cover; transition: transform 0.3s ease;">
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-dark bg-opacity-75 px-3 py-2" style="border-radius: 50px;">
                                            <i class="fas fa-eye me-1"></i>{{ $book->min_age }}+
                                        </span>
                                    </div>
                                </div>

                                <!-- Book Info -->
                                <div class="card-body d-flex flex-column p-4">
                                    <h5 class="card-title fw-bold text-dark mb-2 text-center" style="min-height: 50px; display: flex; align-items: center; justify-content: center;">
                                        {{ Str::limit($book->title, 40) }}
                                    </h5>
                                    <p class="card-text text-muted text-center mb-3">
                                        <i class="fas fa-user-edit me-1"></i>{{ $book->author }}
                                    </p>
                                    
                                    <!-- Book Stats -->
                                    <div class="row text-center mb-3">
                                        <div class="col-6">
                                            <div class="bg-light rounded-3 p-2">
                                                <small class="text-muted d-block">Preu</small>
                                                <span class="fw-bold text-success">{{ number_format($book->price, 2) }}€</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-light rounded-3 p-2">
                                                <small class="text-muted d-block">Categoria</small>
                                                <span class="fw-bold text-primary">{{ $book->category->name ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Button -->
                                    <div class="mt-auto">
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" 
                                              onsubmit="return confirm('Estàs segur que vols eliminar el llibre \'{{ $book->title }}\'?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100 py-3 border-0 fw-bold delete-btn" 
                                                    style="border-radius: 15px; background: linear-gradient(45deg, #ff6b6b, #ee5a52); transition: all 0.3s ease;">
                                                <i class="fas fa-trash-alt me-2"></i>Eliminar Llibre
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-10 rounded-circle mb-4" style="width: 120px; height: 120px;">
                    <i class="fas fa-book-open text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                </div>
                <h3 class="text-white mb-3">No hi ha llibres disponibles</h3>
                <p class="text-white-50 mb-4">No s'han trobat llibres per eliminar en aquesta categoria.</p>
                <a href="{{ route('books.index') }}" class="btn btn-light btn-lg px-4 py-3" style="border-radius: 50px;">
                    <i class="fas fa-arrow-left me-2"></i>Tornar al Catàleg
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if ($books->hasPages() && $books->count() > 0)
            <nav aria-label="Page navigation" class="mt-5">
                <div class="d-flex justify-content-center">
                    <div class="bg-white bg-opacity-10 rounded-pill p-2 backdrop-blur">
                        <ul class="pagination pagination-lg mb-0 border-0">
                            {{-- Previous Button --}}
                            @if ($books->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link bg-transparent border-0 text-white-50 px-4 py-3">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link bg-transparent border-0 text-white px-4 py-3 hover-effect" 
                                       href="{{ $books->previousPageUrl() }}" rel="prev">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($books->links()->elements[0] as $page => $url)
                                @if ($page == $books->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link bg-white text-dark border-0 px-4 py-3 mx-1 fw-bold" 
                                              style="border-radius: 15px;">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link bg-transparent border-0 text-white px-4 py-3 mx-1 hover-effect" 
                                           href="{{ $url }}" style="border-radius: 15px;">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Button --}}
                            @if ($books->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link bg-transparent border-0 text-white px-4 py-3 hover-effect" 
                                       href="{{ $books->nextPageUrl() }}" rel="next">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link bg-transparent border-0 text-white-50 px-4 py-3">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        <!-- Back to Catalog Button -->
        <div class="text-center mt-5">
            <a href="{{ route('books.index') }}" class="btn btn-outline-light btn-lg px-5 py-3" 
               style="border-radius: 50px; border-width: 2px; backdrop-filter: blur(10px);">
                <i class="fas fa-arrow-left me-2"></i>Tornar al Catàleg Principal
            </a>
        </div>
    </div>
</div>

<style>
    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2) !important;
    }
    
    .book-card:hover img {
        transform: scale(1.05);
    }
    
    .delete-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
        background: linear-gradient(45deg, #ee5a52, #ff6b6b) !important;
    }
    
    .hover-effect:hover {
        background-color: rgba(255,255,255,0.2) !important;
        transform: translateY(-2px);
        border-radius: 15px !important;
    }
    
    .backdrop-blur {
        backdrop-filter: blur(10px);
    }
    
    @media (max-width: 768px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .book-card {
            margin-bottom: 1rem;
        }
    }
</style>

@endsection