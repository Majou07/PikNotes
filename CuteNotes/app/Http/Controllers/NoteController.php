<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function index()
    {
        $notes = DB::table('notes')
            ->orderByDesc('created_at')
            ->get();

        return view('notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DB::table('notes')->insert([
            'title'      => $request->title,
            'content'    => $request->content,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('notes')
            ->with('success', 'Nota creada correctamente');
    }
}
