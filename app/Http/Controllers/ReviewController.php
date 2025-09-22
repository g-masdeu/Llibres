<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Controlador per crear una ressenya
    public function create ($id) {

        // Obtenim les dades del llibre
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('reviews.create', compact('book', 'categories'));
    }

    // Controlador per guardar una ressenya
    public function store (Request $request, $id) {

        // Obtenim el llibre
        $book = Book::findOrFail($id);
        
        // Validem les dades abans de guardar
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required|string|max:1000'
        ]);

        // Guardem la ressenya
        Review::create([
            'rating' => $request->rating,
            'review' => $request->review,
            'user_id' => Auth::id(),
            'book_id' => $book->id,
        ]);

        return redirect()->route('books.show', $book->id)->with('success', 'Ressenya afegida correctament');
    }

    // Controlador per eliminar una ressenya
    public function destroy($id) {
        $review = Review::findOrFail($id);
        $book = $review->book; 
        $review->delete();
        return redirect()->route('books.show', $book->id)->with('success', 'Ressenya eliminada correctament');
    }
}
