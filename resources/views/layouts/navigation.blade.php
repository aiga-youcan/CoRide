<nav class="bg-white shadow-md border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xl">
                    🚗
                </div>

                <div>
                    <h1 class="text-xl font-bold text-blue-700">
                        CoRide
                    </h1>
                    <p class="text-xs text-gray-500">
                        Plateforme de covoiturage
                    </p>
                </div>
            </div>

            <!-- Menu -->
            <div class="hidden md:flex items-center gap-8">

                <a href="{{ route('dashboard') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium">
                    Dashboard
                </a>

                <a href="{{ route('trajets.index') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium">
                    Trajets
                </a>

                <a href="{{ route('reservations.index') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium">
                    Réservations
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium">
                    Profil
                </a>

            </div>

            <!-- User -->
            <div class="flex items-center gap-4">

                <div class="text-right">
                    <p class="font-semibold">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ Auth::user()->role }}
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                        Déconnexion
                    </button>
                </form>

            </div>

        </div>
    </div>
</nav>