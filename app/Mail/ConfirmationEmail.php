<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $contexte; // Exemple: "Inscription Club" ou "Newsletter"

    public function __construct($contexte)
    {
        $this->contexte = $contexte;
    }

    public function build()
    {
        // On charge la vue que tu as fournie
        return $this->subject('Bienvenue chez ADA - Confirmation')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->view('emails.confirmation'); 
    }
}