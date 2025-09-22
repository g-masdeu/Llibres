    @extends('layouts.master')
    @section('title', 'Editar llibre')
    @section('content')

        <div class="my-5">
            <div class="row" style="margin-top:40px;">
                <div class="offset-md-3 col-md-6">
                    <div class="card-header text-center">
                        📖 Editar Llibre
                    </div>

                    <div class="card-body" style="padding: 30px;">

                        <!-- Formulari per l'edició -->
                        <form action="{{ route('books.update', $book->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Títol -->
                            <div class="form-group">
                                <label for="title">Títol</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}">
                            </div>

                            <!-- Autor -->
                            <div class="form-group">
                                <label for="author">Autor</label>
                                <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}">
                            </div>

                            <!-- Resum -->
                            <div class="form-group">
                                <label for="summary">Resum</label>
                                <textarea name="summary" id="summary" class="form-controll" rows="3" cols="91">{{ old('summary', $book->summary) }}</textarea>
                            </div>

                            <!-- Data publicació -->
                            <div class="form-group">
                                <label for="publication_date">Data de publicació (AAAA-MM-DD)</label>
                                <input type="date" name="publication_date" id="publication_date" class="form-control" value="{{ old('publication_date', $book->publication_date) }}">
                            </div>

                            <!-- Preu -->
                            <div class="form-group">
                                <label for="price">Preu</label>
                                <input type="number" min="0" max="1000000" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $book->price)}}" onwheel="this.blur()">
                            </div>

                            <!-- Edat mínima -->
                            <div class="form-group">
                                <label for="min_age">Edat mínima recomenada</label>
                                <input type="number" name="min_age" id="min_age" class="form-control" value="{{ old('min_age', $book->min_age) }}" onwheel="this.blur()" />
                            </div>

                            <!-- Imatge -->
                            <div class="form-group">
                                <label for="image">Imatge</label>
                                <input type="text" name="image" id="image" class="form-control"  value="{{ old('image', $book->image) }}">
                            </div>

                            <!-- Categoria -->
                            <div class="form-group">
                                <label for="category">Categoria</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Selecciona una categoria</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>                            

                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                                    Editar llibre
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>


        </div>
    @endsection
