<?php
// app/Http/Controllers/FlashcardController.php
// CÓDIGO COMPLETO Y CORRECTO (SIN user_id)

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlashcardController extends Controller
{
    public function index()
    {
        $categories = DB::table('flashcard_categories')
            ->orderByDesc('created_at')
            ->get();

        return view('flashcards', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'question.*'    => 'required|string',
            'answer.*'      => 'required|string',
        ]);

        $categoryId = DB::table('flashcard_categories')->insertGetId([
            'name'       => $request->category_name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($request->question as $i => $question) {
            DB::table('flashcards')->insert([
                'flashcard_category_id' => $categoryId,
                'question'              => $question,
                'answer'                => $request->answer[$i],
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }

        return redirect()->route('flashcards');
    }

    public function show($id)
    {
        $category = DB::table('flashcard_categories')
            ->where('id', $id)
            ->first();

        $cards = DB::table('flashcards')
            ->where('flashcard_category_id', $id)
            ->get();

        return response()->json([
            'category' => $category,
            'cards'    => $cards,
        ]);
    }
}
