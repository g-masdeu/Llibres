<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="card h-100 border-0 shadow-lg book-card" style="border-radius: 20px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
        <div class="position-relative overflow-hidden" style="border-radius: 20px 20px 0 0;">
            <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none">
                <img src="{{ $book->image }}" alt="{{ $book->title }}" class="card-img-top book-image" style="height: 280px; object-fit: cover; transition: transform 0.4s ease;">
            </a>
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 50px; font-size: 0.8rem;">
                    <i class="fas fa-child me-1"></i>{{ $book->min_age }}+
                </span>
            </div>
            <div class="position-absolute top-0 start-0 m-3">
                @if ($book->reviews_count)
                    <span class="badge bg-warning text-dark px-3 py-2" style="border-radius: 50px; font-size: 0.8rem;">
                        <i class="fas fa-star me-1"></i>{{ number_format($book->reviews_avg_rating, 1) }}
                    </span>
                @else
                    <span class="badge bg-secondary px-3 py-2" style="border-radius: 50px; font-size: 0.8rem;">
                        <i class="fas fa-star me-1"></i>--
                    </span>
                @endif
            </div>
        </div>
        <div class="card-body d-flex flex-column p-4">
            <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none">
                <h5 class="card-title fw-bold text-dark mb-3 book-title" style="min-height: 60px; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    {{ $book->title }}
                </h5>
            </a>
            <div class="mb-3">
                <p class="card-text text-muted mb-2">
                    <i class="fas fa-user-edit me-2 text-primary"></i>
                    <strong>{{ $book->author }}</strong>
                </p>
                @if($book->category)
                    <p class="card-text text-muted mb-0">
                        <i class="fas fa-tag me-2 text-primary"></i>
                        {{ $book->category->name }}
                    </p>
                @endif
            </div>
            <div class="row text-center mt-auto">
                <div class="col-6">
                    <div class="bg-light rounded-3 p-3 h-100">
                        <i class="fas fa-euro-sign text-success mb-2"></i>
                        <div class="fw-bold text-success">{{ number_format($book->price, 2) }}€</div>
                        <small class="text-muted">Preu</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-light rounded-3 p-3 h-100">
                        <i class="fas fa-comments text-info mb-2"></i>
                        <div class="fw-bold text-info">{{ $book->reviews_count ?? 0 }}</div>
                        <small class="text-muted">Ressenyes</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
