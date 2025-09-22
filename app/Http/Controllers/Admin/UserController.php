<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Controlador per mostrar la llista d'usuaris
    public function index() {
        $users = User::all();
        $categories = Category::all();
        return view('users.index', compact('users', 'categories'));
    }

    // controlador per editar un usuari
    public function edit ($id) {
        $user = User::findOrFail($id);
        $categories = Category::all();
        return view('users.edit', compact('user', 'categories'));
    }

    // Controlador per acutlitzar un usuari editat
    public function update (Request $request, $id) {

        //Validem les dades
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'birth_date' => 'required|date',
        ]);

        // Obtenim l'usuari a actualitzar
        $user = User::findOrFail($id);

        // Actualitzem els valors
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birth_date = $request->input('birth_date');

        // Si s'ha actualitzat la contrasenya
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Guardem els canvis
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuari actualitzat correctament!');
    }

    // Controlador per crear un usuari
    public function create() {
        $categories = Category::all();
        return view('users.create', compact('categories'));
    }

    // Controlador per guardar un usuari
    public function store(Request $request) {
        // Validem les dades
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'birth_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Creem l'usuari
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date, 
        ]);

        return redirect()->route('users.index');
    }

    // Controlador pel formulari d'eliminar usuari
    public function delete () {
        $categories = Category::all();
        $users = User::all();
        return view ('users.delete', compact('users', 'categories'));
    }

    // Controlador per eliminar un usuari
    public function destroy(Request $request) {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $user = User::findOrFail($request->input('user_id'));
        $user->delete();

        return redirect()->route('users.delete')->with('success', 'Usuari eliminat correctament!');
    }
}
