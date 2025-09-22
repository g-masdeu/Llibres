@extends('layouts.master')

@section('title', 'Nova ressenya')

@section('content')
<div class="container mt-5">
    <h2>Escriu una ressenya per <strong>{{ $book->title }}</strong></h2>

    <form action="{{ route('reviews.store', $book->id) }}" method="POST" class="mt-4">
        @csrf

        <div class="form-group">
            <label for="rating">Puntuació (1-10)</label>
            <input type="number" name="rating" id="rating" class="form-control" min="1" max="10" required>
        </div>

        <div class="form-group mt-3">
            <label for="review">Ressenya</label>
            <textarea name="review" id="review" rows="4" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Enviar ressenya</button>
        <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary mt-4">Cancel·lar</a>
    </form>
</div>
@endsection
