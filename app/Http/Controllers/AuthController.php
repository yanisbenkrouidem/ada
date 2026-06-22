<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Affiche la page de login
    public function login() {
        return view('auth.login');
    }

    // 2. Vérifie le mot de passe
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tente de connecter l'utilisateur via la table 'users'
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirection vers le dashboard
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    // 3. Déconnexion
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
