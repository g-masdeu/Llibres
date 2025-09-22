<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Controlador per les categories
    public function index () {
        $categories = Category::all();
        return view ('categories.index', compact('categories'));
    }

    // Controlador per editar una categoria
    public function edit ($id) {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        return view ('categories.edit', compact('categories', 'category'));
    }

    // Controlador per actualitzar una categoria
    public function update (Request $request, $id) {
        // Validem les dades
        $validated = $request->validate([
            'name'=>'required|string|max:255'
        ]);

        // Obtenim la categoria a actualitzar
        $category = Category::findOrFail($id);

        // Actualitzem els valors
        $category->name = $request->input('name');
    }
    
    // Controlador per crear una categoria
    public function create() {
        $categories = Category::all();
        return view ('categories.create', compact('categories'));
    }

    // Controlador per guardar una cateogria
    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:255']);
        Category::create(['name' => $request->input('name')]);
        return redirect()->route('books.index')->with('success', 'Categoria creada correctament!');
    }

    //Controlador per mostrar la vista de la eliminació d'una categoria
    public function delete() {
        $categories = Category::all();
        return view('categories.delete', compact('categories'));
    }

    // Controlador per eliminar una categoria
    public function destroy(Request $request) {
        $request->validate(['category_id' => 'required|exists:categories,id']);
        $category = Category::findOrFail($request->input('category_id'));
        $category->delete();
        return redirect()->route('categories.delete')->with('success', 'Categoria eliminada correctament!');
    }
}
