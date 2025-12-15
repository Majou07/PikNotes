<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteQuizController extends Controller
{
  public function index()
{
    $notes = DB::table('notes')->latest()->get();
    $quizzes = DB::table('quizzes')->latest()->get();

    // 👉 lógica DEMO: mostrar welcome si no hay notas ni quizzes
    $showWelcome = $notes->isEmpty() && $quizzes->isEmpty();

    return view('notas', compact('notes', 'quizzes', 'showWelcome'));
}

    public function storeNote(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        DB::table('notes')->insert([
                'user_id'    => 1, // usuario demo
            'title'      => $request->title,
            'content'    => $request->content,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('notes');
    }

    public function storeQuiz(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $quizId = DB::table('quizzes')->insertGetId([
            'title'      => $request->title,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('quiz_questions')->insert([
            'quiz_id'        => $quizId,
            'question'       => $request->question,
            'option_a'       => $request->option_a,
            'option_b'       => $request->option_b,
            'option_c'       => $request->option_c,
            'option_d'       => $request->option_d,
            'correct_option' => $request->correct_option,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('notes');
    }

    public function getQuiz($id)
    {
        $quiz = DB::table('quizzes')->where('id', $id)->first();
        $questions = DB::table('quiz_questions')
            ->where('quiz_id', $id)
            ->get();

        return response()->json([
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }
}
