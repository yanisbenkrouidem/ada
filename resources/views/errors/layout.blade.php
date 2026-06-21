<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADA - Erreur @yield('code')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/ada.png') }}">
    <style>body { font-family: 'Poppins', sans-serif; background-color: #f9f9f9; }</style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl p-12 max-w-lg w-full text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            Erreur <span class="text-[#f43f4a]">@yield('code')</span>
        </h1>
        <p class="text-gray-800 font-medium mb-6">
            @yield('message')
        </p>
        <p class="text-xs text-gray-500 mb-8 px-4">
            @yield('detail')
        </p>
        <a href="{{ url('/') }}" class="inline-block bg-[#2d2d2d] text-white font-bold py-3 px-6 rounded hover:bg-black transition-colors text-sm shadow-md">
            Retour à l'accueil
        </a>
    </div>
</body>
</html>