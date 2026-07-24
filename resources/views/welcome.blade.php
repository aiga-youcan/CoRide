<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoRide - Plateforme de Covoiturage</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white text-2xl">
                    🚗
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-blue-700">
                        CoRide
                    </h1>

                    <p class="text-sm text-gray-500">
                        Covoiturage Inter-Entreprise
                    </p>
                </div>
            </div>

            <div class="flex gap-4">

                <a href="{{ route('login') }}"
                    class="px-5 py-2 border border-blue-600 text-blue-600 rounded-xl hover:bg-blue-50 transition">
                    Se connecter
                </a>

                <a href="{{ route('register') }}"
                    class="px-5 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                    Créer un compte
                </a>

            </div>

        </div>
    </nav>

    <!-- Hero -->
    <section class="max-w-7xl mx-auto px-8 py-20">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Texte -->
            <div>

                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                    🚀 Nouvelle génération de covoiturage
                </span>

                <h1 class="text-6xl font-extrabold text-gray-800 mt-8 leading-tight">
                    Partagez vos trajets
                    <span class="text-blue-600">
                        facilement
                    </span>
                </h1>

                <p class="text-gray-600 text-xl mt-6 leading-9">
                    CoRide aide les collaborateurs des entreprises partenaires
                    à partager leurs trajets domicile-travail grâce à un
                    système intelligent de matching basé sur l'IA.
                </p>

                <div class="flex gap-5 mt-10">

                    <a href="{{ route('register') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl shadow-lg font-semibold">
                        Commencer
                    </a>

                    <a href="{{ route('login') }}"
                        class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-8 py-4 rounded-2xl font-semibold">
                        Se connecter
                    </a>

                </div>

            </div>

            <!-- Illustration -->
            <div class="flex justify-center">

                <div class="bg-white rounded-3xl shadow-2xl p-12">

                    <div class="text-[150px] text-center">
                        🚗
                    </div>

                    <h2 class="text-3xl font-bold text-center mt-6">
                        Bienvenue sur CoRide
                    </h2>

                    <p class="text-center text-gray-500 mt-3">
                        Voyagez ensemble,
                        économisez et réduisez votre empreinte carbone.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- Avantages -->
    <section class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-8">

            <h2 class="text-4xl font-bold text-center mb-16">
                Pourquoi choisir CoRide ?
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-slate-50 rounded-3xl p-8 shadow hover:shadow-xl transition">

                    <div class="text-6xl mb-5">
                        🤖
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Matching IA
                    </h3>

                    <p class="text-gray-600">
                        Analyse intelligente des trajets pour trouver les meilleurs covoitureurs.
                    </p>

                </div>

                <div class="bg-slate-50 rounded-3xl p-8 shadow hover:shadow-xl transition">

                    <div class="text-6xl mb-5">
                        💰
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Économisez
                    </h3>

                    <p class="text-gray-600">
                        Réduisez vos frais de transport tout en voyageant confortablement.
                    </p>

                </div>

                <div class="bg-slate-50 rounded-3xl p-8 shadow hover:shadow-xl transition">

                    <div class="text-6xl mb-5">
                        🌍
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Écologique
                    </h3>

                    <p class="text-gray-600">
                        Moins de voitures, moins de pollution, un meilleur avenir.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-8">

        <div class="text-center">

            <h3 class="text-2xl font-bold">
                🚗 CoRide
            </h3>

            <p class="text-gray-400 mt-3">
                © {{ date('Y') }} CoRide - Tous droits réservés.
            </p>

        </div>

    </footer>

</body>

</html>