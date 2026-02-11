<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    // Controlador per mostrar tots els llibres
    public function index()
    {

        // Comprobem que s'ha iniciat la sessió
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        //Calculem l'edat de l'usuari
        $user = Auth::user();
        $birthDate = Carbon::parse($user->birth_date);
        $age = $birthDate->age;

        // Obtenir les categories
        $categories = Category::all();


        // Obtenir tots els llibres
        $books = Book::with(['category'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where('min_age', '<=', $age)
            ->paginate(8);

        // Pasem la vista 
        return view('books.index', compact('books', 'categories'));
    }

    // Filtrar las películas por categoría
    public function showCategory($id)
    {

        // Comprobem que s'ha iniciat la sessió
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        //Calculem l'edat de l'usuari
        $user = Auth::user();
        $birthDate = Carbon::parse($user->birth_date);
        $age = $birthDate->age;
        $category = Category::findOrFail($id);

        // Agafem els llibres que tinguin edat minima < edat usuari I que siguin de la categoria seleccionada
        $books = Book::with(['category'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where('category_id', $id)  // Filtrem per categoria
            ->where('min_age', '<=', $age)
            ->paginate(8);

        // Agafem les categories
        $categories = Category::all();

        return view('books.index', compact('books', 'category', 'categories'));
    }

    // Controlador per mostrar un llibre amb detalls
    public function show($id)
    {

        // Obtenim les dades per passar a la vista 
        $book = Book::with(['category', 'reviews.user'])->findOrFail($id);
        $categories = Category::all();

        // Passem les variables a la vista
        return view('books.show', compact('book', 'categories'));
    }

    // Controlador per mostrar els resultats d'unabúsqueda
    public function search(Request $request)
    {
        if (!Auth::check()) return response()->json([], 403);

        $query = $request->input('query');
        if (!$query) return response()->json([]);

        $user = Auth::user();
        $age = Carbon::parse($user->birth_date)->age;

        $results = Book::where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('author', 'like', "%{$query}%");
        })
            ->where('min_age', '<=', $age)
            ->limit(7)
            ->get(['id', 'title', 'author', 'image']);

        return response()->json($results);
    }


    // Controlador per crear un llibre nou
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // Controlador per editar un llibre
    public function edit($id)
    {

        // Preparem les dades per passar a la vista
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    // Controlador per actualitzar un llibre
    public function update(Request $request, $id)
    {
        // Validem que les dades siguin correctes
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'summary' => 'required|string',
            'publication_date' => 'required|date',
            'price' => 'required|numeric|min:0|max:1000000',
            'image' => 'required|url',
            'min_age' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Obtenim el llibre a actualitzar
        $book = Book::findOrFail($id);

        // Actualitzem els valors
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->summary = $request->input('summary');
        $book->publication_date = $request->input('publication_date');
        $book->price = $request->input('price');
        $book->image = $request->input('image');
        $book->min_age = $request->input('min_age');
        $book->category_id = $request->input('category_id');

        // Guardem els canvis
        $book->save();

        //Redirigim a la pàgina principal
        return redirect()->route('books.index')->with('success', 'Llibre actualitzat correctament');
    }

    // Controlador per guardar un llibre
    public function store(Request $request)
    {
        //Validem les dades abans de crear el llibre
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'summary' => 'required|string',
            'publication_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url',
            'min_age' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Creem el llibre
        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'summary' => $validated['summary'],
            'publication_date' => $validated['publication_date'],
            'price' => $validated['price'],
            'image' => $validated['image'],
            'min_age' => $validated['min_age'],
            'category_id' => $validated['category_id']
        ]);

        // Redirigim a la llista de llibres
        return redirect()->route('books.index')->with('success', 'Llibre creat correctament');
    }

    // Controlador per passar a la pàgina de confirmació d'eliminació d'un llibre
    public function delete()
    {

        // Preparem les dades de tots els llibres abans de passar a la vista
        $books = Book::paginate(8);
        $categories = Category::all();

        return view('books.delete', compact('books', 'categories'));
    }

    // Controlador per elimiar un llibre
    public function destroy($id)
    {
        // Busquem el llibre i l'eliminem
        $book = Book::findOrFail($id);
        $book->delete();

        // Redirigim a la pàgina d'eliminació de llibres
        return redirect()->route('books.index')->with('success', 'Llibre eliminat correctament');
    }
}
