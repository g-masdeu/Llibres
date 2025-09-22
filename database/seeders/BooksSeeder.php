<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::insert([
            [
                'title' => 'Cien Años de Soledad',
                'author' => 'Gabriel García Márquez',
                'summary' => 'La historia épica de la familia Buendía en el mítico pueblo de Macondo.',
                'publication_date' => '1967-05-30',
                'price' => 19.99,
                'image' => 'images/cien_anos_de_soledad.jpg',
                'min_age' => 16,
                'category_id' => 1, 
            ],
            [
                'title' => 'El Principito',
                'author' => 'Antoine de Saint-Exupéry',
                'summary' => 'Un pequeño príncipe viaja a distintos planetas aprendiendo lecciones de vida.',
                'publication_date' => '1943-04-06',
                'price' => 12.99,
                'image' => 'images/el_principito.jpg',
                'min_age' => 8,
                'category_id' => 2,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'summary' => 'Una visión distópica de un futuro totalitario donde todo está vigilado.',
                'publication_date' => '1949-06-08',
                'price' => 15.99,
                'image' => 'images/1984.jpg',
                'min_age' => 16,
                'category_id' => 1,
            ],
            [
                'title' => 'Don Quijote de la Mancha',
                'author' => 'Miguel de Cervantes',
                'summary' => 'Las aventuras y desventuras de un caballero idealista y su escudero Sancho Panza.',
                'publication_date' => '1605-01-16',
                'price' => 22.50,
                'image' => 'images/don_quijote.jpg',
                'min_age' => 14,
                'category_id' => 3,
            ],
            [
                'title' => 'Harry Potter y la piedra filosofal',
                'author' => 'J.K. Rowling',
                'summary' => 'El joven Harry descubre que es un mago y asiste a la escuela Hogwarts.',
                'publication_date' => '1997-06-26',
                'price' => 18.00,
                'image' => 'images/harry_potter1.jpg',
                'min_age' => 10,
                'category_id' => 2,
            ],
            [
                'title' => 'El Hobbit',
                'author' => 'J.R.R. Tolkien',
                'summary' => 'La aventura de Bilbo Bolsón en la Tierra Media en busca del tesoro de Smaug.',
                'publication_date' => '1937-09-21',
                'price' => 17.50,
                'image' => 'images/el_hobbit.jpg',
                'min_age' => 12,
                'category_id' => 2,
            ],
            [
                'title' => 'Orgullo y Prejuicio',
                'author' => 'Jane Austen',
                'summary' => 'La historia de Elizabeth Bennet enfrentándose a temas de amor, orgullo y malentendidos.',
                'publication_date' => '1813-01-28',
                'price' => 14.75,
                'image' => 'images/orgullo_prejuicio.jpg',
                'min_age' => 14,
                'category_id' => 3,
            ],
            [
                'title' => 'Los Juegos del Hambre',
                'author' => 'Suzanne Collins',
                'summary' => 'Katniss Everdeen lucha por sobrevivir en un despiadado reality show distópico.',
                'publication_date' => '2008-09-14',
                'price' => 16.99,
                'image' => 'images/los_juegos_del_hambre.jpg',
                'min_age' => 13,
                'category_id' => 2,
            ],
        ]);
    }
}
