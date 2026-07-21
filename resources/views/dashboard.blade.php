@extends('layouts.app')

@section('content')

<div class="mb-8">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-4xl font-bold text-gray-800">
                Bonjour, {{ Auth::user()->name }} 👋
            </h1>

            <p class="text-gray-500 mt-2">
                Bienvenue sur votre espace CoRide.
            </p>
        </div>

        <a href="{{ route('trajets.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow-lg">
            + Nouveau trajet
        </a>

    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-2xl p-6 text-white shadow-lg">

        <p class="text-sm uppercase opacity-80">
            Mes trajets
        </p>

        <h2 class="text-4xl font-bold mt-3">
            {{ $trajets->count() }}
        </h2>

        <p class="mt-4 opacity-80">
            Trajets publiés
        </p>

    </div>

    <div class="bg-gradient-to-r from-green-600 to-green-400 rounded-2xl p-6 text-white shadow-lg">

        <p class="text-sm uppercase opacity-80">
            Réservations
        </p>

        <h2 class="text-4xl font-bold mt-3">
            {{ $reservations->count() }}
        </h2>

        <p class="mt-4 opacity-80">
            Total
        </p>

    </div>

    <div class="bg-gradient-to-r from-yellow-500 to-orange-400 rounded-2xl p-6 text-white shadow-lg">

        <p class="text-sm uppercase opacity-80">
            Confirmées
        </p>

        <h2 class="text-4xl font-bold mt-3">
            {{ $reservations->where('statut','confirmee')->count() }}
        </h2>

        <p class="mt-4 opacity-80">
            Validées
        </p>

    </div>

    <div class="bg-gradient-to-r from-red-600 to-pink-500 rounded-2xl p-6 text-white shadow-lg">

        <p class="text-sm uppercase opacity-80">
            En attente
        </p>

        <h2 class="text-4xl font-bold mt-3">
            {{ $reservations->where('statut','en_attente')->count() }}
        </h2>

        <p class="mt-4 opacity-80">
            À traiter
        </p>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mt-10">

    <!-- Mes trajets -->
    <div class="bg-white rounded-2xl shadow-lg">

        <div class="border-b px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-700">
                🚗 Mes trajets
            </h2>

            <a href="{{ route('trajets.index') }}"
               class="text-blue-600 hover:underline">
                Voir tout
            </a>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>
                        <th class="text-left p-4">Départ</th>
                        <th class="text-left p-4">Arrivée</th>
                        <th class="text-left p-4">Horaire</th>
                        <th class="text-center p-4">Places</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($trajets as $trajet)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4 font-semibold">
                            {{ $trajet->ville_depart }}
                        </td>

                        <td class="p-4">
                            {{ $trajet->ville_arrivee }}
                        </td>

                        <td class="p-4">
                            {{ \Carbon\Carbon::parse($trajet->horaire)->format('H:i') }}
                        </td>

                        <td class="text-center p-4">
                            {{ $trajet->places_disponibles }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center p-6 text-gray-500">
                            Aucun trajet disponible.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Mes réservations -->
    <div class="bg-white rounded-2xl shadow-lg">

        <div class="border-b px-6 py-4 flex justify-between items-center">

            <h2 class="text-xl font-bold text-gray-700">
                📅 Mes réservations
            </h2>

            <a href="{{ route('reservations.index') }}"
               class="text-green-600 hover:underline">
                Voir tout
            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">Trajet</th>
                        <th class="text-left p-4">Horaire</th>
                        <th class="text-center p-4">Statut</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($reservations as $reservation)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4">
                            {{ $reservation->trajet->ville_depart }}
                            →
                            {{ $reservation->trajet->ville_arrivee }}
                        </td>

                        <td class="p-4">
                            {{ \Carbon\Carbon::parse($reservation->trajet->horaire)->format('H:i') }}
                        </td>

                        <td class="text-center p-4">

                            @if($reservation->statut=='confirmee')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Confirmée
                                </span>

                            @elseif($reservation->statut=='en_attente')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    En attente
                                </span>

                            @elseif($reservation->statut=='refusee')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Refusée
                                </span>

                            @else

                                <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Annulée
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center p-6 text-gray-500">
                            Aucune réservation.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>