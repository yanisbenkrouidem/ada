@extends('errors.layout')

@section('code', '500')
@section('message', "Maintenance en cours. Pas de panique.")
@section('detail')
    {{-- Décommente la ligne dessous si tu veux voir l'erreur SQL s'afficher sur la page (utile en dev, déconseillé en prod) --}}
    {{-- {{ $exception->getMessage() }} --}}
@endsection