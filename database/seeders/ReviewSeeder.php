<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Review;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Frases segons el tipus de valoració
        $goodReviews = [
            'Un llibre espectacular!',
            'M’ha atrapat des de la primera pàgina.',
            'Una joia literària, absolutament recomanable.',
            'Una experiència meravellosa de lectura.',
            'Molt ben escrit i amb una trama captivadora.',
            'Els personatges són inoblidables.',
            'Una lectura que repetiré sens dubte.',
            'Impressionant, no podia deixar de llegir.',
            'L’autor té un estil brillant.',
            'He rigut, plorat i m’ha emocionat.',
            'Una obra d’art de principi a fi.',
            'Perfecte per a qualsevol amant dels llibres.',
            'El millor llibre que he llegit aquest any.',
            'M’ha fet veure el món d’una altra manera.',
            'Totalment immersiu i ple de sorpreses.',
            'Narració impecable, molt ben construïda.',
            'M’ha fet pensar molt, molt enriquidor.',
            'Cada pàgina m’ha mantingut en tensió.',
            'No volia que s’acabés mai.',
            'Tots els elements estan equilibrats a la perfecció.',
            'M’ha deixat sense paraules.',
            'Una obra mestra de la literatura moderna.',
            'Em va emocionar profundament.',
            'L’estil de l’autor és fascinant.',
            'Una gran aportació al seu gènere.',
            'No m’ha decebut gens.',
            'L’he recomanat a tothom.',
            'Supera totes les expectatives.',
            'Excel·lent ritme i desenvolupament.',
            'Una veritable delícia de llibre.',
        ];

        $neutralReviews = [
            'Estava bé, però no m’ha entusiasmat.',
            'Interessant, però lent en alguns moments.',
            'Algunes parts m’han agradat, altres no tant.',
            'No està malament, però no és per tothom.',
            'Em va costar entrar-hi al principi.',
            'L’estil és correcte, però poc sorprenent.',
            'La trama podria haver estat més intensa.',
            'M’esperava una mica més.',
            'Té idees bones però mal executades.',
            'Acceptable, sense destacar massa.',
            'Es deixa llegir, però sense emocionar.',
            'Té moments bons, però irregular.',
            'Alguna cosa m’ha faltat per connectar del tot.',
            'El final m’ha semblat precipitat.',
            'No està malament, però no el tornaria a llegir.',
            'M’ha deixat una mica indiferent.',
            'Correcte però oblidable.',
            'Amb alts i baixos.',
            'Té un bon començament però es desinfla.',
            'Sense més.',
            'No m’ha convençut del tot.',
            'La premissa era bona, l’execució no tant.',
            'El personatge principal no m’ha enganxat.',
            'He tingut dificultats per seguir-lo.',
            'Alguna cosa no m’ha quadrat.',
            'Massa previsible en alguns punts.',
            'Té potencial, però no el desenvolupa.',
            'Poca profunditat en els personatges.',
            'No és dolent, però tampoc bo.',
            'Normal, sense destacar.',
        ];

        $badReviews = [
            'No m’ha agradat gens.',
            'Una pèrdua de temps.',
            'M’esperava molt més.',
            'Molt mal escrit.',
            'M’ha costat molt acabar-lo.',
            'L’he deixat a la meitat.',
            'Massa avorrit i sense ritme.',
            'No he connectat gens amb la història.',
            'Incoherent i mal estructurat.',
            'Decepció absoluta.',
            'No recomanaria aquest llibre.',
            'Els personatges no tenen cap profunditat.',
            'Em va avorrir des del principi.',
            'Massa previsible i tòpic.',
            'Una trama sense sentit.',
            'Massa llarg per al que ofereix.',
            'Escrit de forma molt pobra.',
            'No sé com s’ha publicat això.',
            'M’ha enfadat el final.',
            'Més que un llibre, una tortura.',
            'No aporta res nou.',
            'He llegit coses molt millors.',
            'Ple de clixés i estereotips.',
            'Confús i mal desenvolupat.',
            'Em va decebre des de les primeres pàgines.',
            'Rescataria ben poca cosa.',
            'El pitjor que he llegit últimament.',
            'Gens recomanable.',
            'M’he sentit estafat.',
            'No entenc les bones crítiques que té.',
        ];

        $reviewsToInsert = [];
        $faker = Faker::create();
        $users = User::all();
        $books = Book::all();

        // Recorremos los usuarios
        foreach ($users as $user) {
            if($user->id != 1) {
                // Verificamos que el usuario tenga la edad suficiente para reseñar libros
                $userAge = Carbon::parse($user->birth_date)->age;

                // Recorremos los libros
                foreach ($books as $book) {
                    if ($book->min_age <= $userAge) {
                        // Assigna un rating aleatori
                        $rating = rand(4, 10);

                        // Selecciona la frase segons el rating
                        if ($rating >= 7) {
                            $text = $goodReviews[array_rand($goodReviews)];
                        } elseif ($rating >= 4) {
                            $text = $neutralReviews[array_rand($neutralReviews)];
                        } else {
                            $text = $badReviews[array_rand($badReviews)];
                        }

                        // Prepara los datos para insertar
                        $reviewsToInsert[] = [
                            'user_id' => $user->id,
                            'book_id' => $book->id,
                            'rating' => $rating,
                            'review' => $text,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }
        }

        // Inserta todas las reseñas de una vez
        Review::insert($reviewsToInsert);
    }
}