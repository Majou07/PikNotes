<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Mostrar formulario Login / Registro (demo)
     */
    public function show()
    {
        return view('index');
    }

    /**
     * Login DEMO (sin base de datos)
     */
    public function login(Request $request)
    {
        // Datos de prueba
        $user = [
            'name' => 'Daniel',
            'email' => 'demo@piknotes.com'
        ];

        // Guardamos en sesión (solo demo)
        session([
            'user' => $user,
            'welcome' => true
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Registro DEMO (sin base de datos)
     */
    public function register(Request $request)
    {
        // Datos simulados
        session([
            'user' => [
                'name' => $request->username ?? 'Nuevo Usuario',
                'email' => $request->email ?? 'nuevo@piknotes.com'
            ],
            'welcome' => true
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Cerrar sesión demo
     */
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
