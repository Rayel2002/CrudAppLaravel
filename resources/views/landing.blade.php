<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom bij Reserveringssysteem</title>
    @vite('resources/css/app.css') <!-- Zorg dat Tailwind CSS is ingeladen -->
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-gray-800 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('landing') }}" class="text-lg font-bold">Reserveringssysteem</a>
            <ul class="flex space-x-4">
                @auth
                    <!-- Als de gebruiker is ingelogd -->
                    <li><a href="{{ route('user.profile') }}" class="hover:underline">Profiel</a></li>
                    <li><a href="{{ route('reservations.list') }}" class="hover:underline">Mijn Reserveringen</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline-block">
                            @csrf
                            <button type="submit" class="hover:underline">Uitloggen</button>
                        </form>
                    </li>
                @else
                    <!-- Als de gebruiker niet is ingelogd -->
                    <li><a href="{{ route('login') }}" class="hover:underline">Inloggen</a></li>
                    <li><a href="{{ route('register') }}" class="hover:underline">Registreren</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-white shadow-md py-16">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Welkom bij het Reserveringssysteem</h1>
            <p class="text-lg text-gray-600 mb-6">Beheer al je reserveringen op één plek.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                    Inloggen
                </a>
                <a href="#features" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg shadow hover:bg-gray-300">
                    Meer Informatie
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="container mx-auto py-16">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Wat kun je doen?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Reserveringen beheren</h3>
                <p class="text-gray-600">Bekijk, maak en bewerk reserveringen eenvoudig.</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Gebruikersprofiel aanpassen</h3>
                <p class="text-gray-600">Beheer je profiel en houd je informatie up-to-date.</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Altijd en overal toegankelijk</h3>
                <p class="text-gray-600">Log in vanaf elk apparaat en beheer alles eenvoudig.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} Reserveringssysteem. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>
