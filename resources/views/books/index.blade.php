@extends('layouts.master')
@section('title', 'Inici')
@section('content')

<style>
    .page-background {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .card {
        position: relative;
        border: none;
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
        background-color: transparent;
        box-shadow: 0 10px 25px rgba(118, 75, 162, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0 20px 40px rgba(118, 75, 162, 0.3);
    }

    .card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .card:hover img {
        transform: scale(1.05);
    }

    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(12px);
        color: #4b368c;
    }

    .overlay h5 {
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 0.3rem;
        color: #4b368c;
    }

    .overlay h6 {
        font-size: 1rem;
        font-weight: 500;
        color: #764ba2;
    }

    .star-rating {
        font-size: 1.1rem;
        color: #764ba2;
    }

    .btn-see {
        margin-top: 0.8rem;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.4rem 1.2rem;
        font-size: 0.9rem;
        border: 2px solid #764ba2;
        color: #764ba2;
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-see:hover {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 6px 18px rgba(118, 75, 162, 0.4);
        border-color: transparent;
    }

    .pagination .page-link {
        border-radius: 50px !important;
        border: none;
        margin: 0 5px;
        color: #764ba2;
        background-color: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: linear-gradient(45deg, #c084fc, #f472b6);
        color: white;
        transform: scale(1.05);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(45deg, #a855f7, #ec4899);
        color: white;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

</style>

<div class="page-background">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-white">Catàleg de Llibres</h1>
            <p class="text-white-50">Explora i valora els teus llibres preferits</p>
        </div>

        <div class="row g-4">
            @forelse ($books as $book)
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex">
                    <div class="card w-100">
                        <a href="{{ route('books.show', $book->id) }}">
                            <img src="{{ $book->image }}" alt="{{ $book->title }}" />
                        </a>

                        <div class="overlay">
                            <h5>{{ $book->title }}</h5>
                            <h6>{{ $book->author }}</h6>

                            @if ($book->reviews_count)
                                @php $rounded = round($book->reviews_avg_rating); @endphp
                                <div class="star-rating mb-2">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <span class="{{ $i <= $rounded ? '' : 'text-muted' }}">&#9733;</span>
                                    @endfor
                                </div>
                                <div class="text-muted small">{{ number_format($book->reviews_avg_rating, 1) }}/10</div>
                            @else
                                <div class="text-muted small mb-1">Sense puntuació</div>
                            @endif

                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-see">Veure més</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-white fs-5">No s'han trobat llibres.</p>
                </div>
            @endforelse
        </div>

        @if ($books->hasPages())
            <nav class="mt-5" aria-label="Paginació">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $books->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>

                    @foreach ($books->links()->elements[0] as $page => $url)
                        <li class="page-item {{ $page == $books->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <li class="page-item {{ $books->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $books->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
</div>

@endsection
