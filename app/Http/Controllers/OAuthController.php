<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class OAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $client = Client::where('email', $googleUser->getEmail())->first();

            if (!$client) {
                // Split name
                $nameParts = explode(' ', $googleUser->getName());
                $nom = count($nameParts) > 1 ? array_pop($nameParts) : 'GoogleUser';
                $prenom = count($nameParts) > 0 ? implode(' ', $nameParts) : $googleUser->getName();

                $client = Client::create([
                    'nom' => strtoupper($nom),
                    'prenom' => ucfirst(strtolower($prenom)),
                    'email' => $googleUser->getEmail(),
                    'motpasse' => Hash::make(Str::random(16)),
                    'telephone' => 'A renseigner', 
                    'newsletter_optin' => 0,
                    'sms_optin' => 0
                ]);
            }

            Auth::guard('client')->login($client);

            Session::put('client_id', $client->id);
            Session::put('client_email', $client->email);
            Session::put('client_nom', strtoupper($client->nom) . ' ' . ucfirst(strtolower($client->prenom)));

            return redirect()->route('home')->with('success', 'Connexion via Google réussie !');

        } catch (\Exception $e) {
            return redirect()->route('client.login.form')->with('error', 'Erreur de connexion avec Google : ' . $e->getMessage());
        }
    }
}
