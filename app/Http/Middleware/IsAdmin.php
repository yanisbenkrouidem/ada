<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // TON EMAIL QUI SERT DE CLEF
        $adminEmail = 'yanis.benkrouidem@gmail.com'; 

        // 1. Si l'utilisateur n'est pas connecté, on l'envoie se connecter
        if (!auth()->check()) {
            return redirect('/login');
        }

        // 2. Si l'email n'est pas le tien, on bloque
        if (auth()->user()->email !== $adminEmail) {
            abort(403, "ACCÈS INTERDIT : Vous n'êtes pas l'administrateur (Yanis).");
        }

        // 3. C'est toi ? Ok, tu passes.
        return $next($request);
    }
}