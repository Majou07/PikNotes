<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\Note;
// use App\Models\Flashcard;

class DashboardController extends Controller
{
   public function index()
    {
        // Usuario simulado
        $user = (object) [
            'name' => 'Daniel',
        ];

        // Mostrar mensaje de bienvenida (solo demo)
        $showWelcome = true;

        // Notas simuladas
        $notes = collect([
            (object) [
                'title' => 'Introducción a Laravel',
                'content' => 'Notas básicas sobre rutas, controladores y vistas.',
            ],
            (object) [
                'title' => 'Apuntes de Inglés',
                'content' => 'Vocabulario básico y tiempos verbales.',
            ],
            (object) [
                'title' => 'Ideas de proyecto',
                'content' => 'Funcionalidades futuras para PikNotes.',
            ],
            (object) [
                'title' => 'Resumen de IA',
                'content' => 'Conceptos clave de inteligencia artificial.',
            ],
        ]);

        // Flashcards simuladas
        $flashcards = collect([
            (object) [
                'category' => 'Inglés',
                'question' => 'What does "break down" mean?',
                'answer' => 'To stop functioning',
            ],
            (object) [
                'category' => 'Inglés 1',
                'question' => 'Past of "go"',
                'answer' => 'Went',
            ],
            (object) [
                'category' => 'Programación',
                'question' => '¿Qué es MVC?',
                'answer' => 'Modelo Vista Controlador',
            ],
            (object) [
                'category' => 'IA',
                'question' => '¿Qué es Machine Learning?',
                'answer' => 'Aprendizaje automático basado en datos',
            ],
        ]);

        return view('dashboard', compact(
            'user',
            'notes',
            'flashcards',
            'showWelcome'
        ));
    }
}