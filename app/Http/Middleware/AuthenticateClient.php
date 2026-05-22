<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateClient
{
    /**
     * Gérer une requête entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si la variable 'client_id' existe en session (défini dans ClientController->login/register)
        if (!session()->has('client_id')) {
            // Si le client n'est pas connecté, le rediriger vers la page de connexion
            return redirect()->route('client.login.form')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        return $next($request);
    }
}