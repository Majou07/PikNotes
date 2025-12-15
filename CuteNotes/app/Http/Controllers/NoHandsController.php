<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoHandsController extends Controller
{
    public function toggle(Request $request)
    {
        $active = session()->get('nohands_active', false);

        if ($active) {
            // Detener servicio Python
            Http::post('http://127.0.0.1:5000/stop');
            session()->put('nohands_active', false);
        } else {
            // Iniciar servicio Python
            Http::post('http://127.0.0.1:5000/start');
            session()->put('nohands_active', true);
        }

        return redirect()->back();
    }
}
