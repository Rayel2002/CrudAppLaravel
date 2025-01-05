<nav class="bg-gray-800 p-4 text-white">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('landing') }}" class="text-lg font-bold">Reserveringssysteem</a>
        <ul class="flex space-x-4">
            @auth
                <!-- Als gebruiker is ingelogd -->
                <li><a href="{{ route('user.profile') }}" class="hover:underline">Profiel</a></li>
                <li><a href="{{ route('user.reservations') }}" class="hover:underline">Mijn Reserveringen</a></li>
                <li><a href="{{ route('reservations.list') }}" class="hover:underline">Alle Reserveringen</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:underline">Uitloggen</button>
                    </form>
                </li>
            @else
                <!-- Als gebruiker niet is ingelogd -->
                <li><a href="{{ route('login') }}" class="hover:underline">Inloggen</a></li>
                <li><a href="{{ route('register') }}" class="hover:underline">Registreren</a></li>
            @endauth
        </ul>
    </div>
</nav>
