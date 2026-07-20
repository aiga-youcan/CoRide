@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-8">

    <h1 class="text-3xl font-bold mb-8">
        Tableau de bord CoRide
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-blue-500 text-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold">Mes trajets</h2>
            <p class="text-4xl mt-4">
                {{ $trajets->count() }}
            </p>
        </div>

        <div class="bg-green-500 text-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold">Mes réservations</h2>
            <p class="text-4xl mt-4">
                {{ $reservations->count() }}
            </p>
        </div>

        <div class="bg-yellow-500 text-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold">Réservations confirmées</h2>
            <p class="text-4xl mt-4">
                {{ $reservations->where('statut','confirmee')->count() }}
            </p>
        </div>

        <div class="bg-red-500 text-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold">En attente</h2>
            <p class="text-4xl mt-4">
                {{ $reservations->where('statut','en_attente')->count() }}
            </p>
        </div>

    </div>

    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white rounded-lg shadow p-6">

            <h2 class="text-xl font-bold mb-4">
                Mes trajets
            </h2>

            @forelse($trajets as $trajet)

                <div class="border-b py-3">

                    <p>
                        <strong>{{ $trajet->ville_depart }}</strong>

                        →

                        <strong>{{ $trajet->ville_arrivee }}</strong>
                    </p>

                    <p>
                        {{ \Carbon\Carbon::parse($trajet->horaire)->format('d/m/Y H:i') }}
                    </p>

                    <p>
                        Places :
                        {{ $trajet->places_disponibles }}
                    </p>

                </div>

            @empty

                <p>Aucun trajet publié.</p>

            @endforelse

        </div>

        <div class="bg-white rounded-lg shadow p-6">

            <h2 class="text-xl font-bold mb-4">
                Mes réservations
            </h2>

            @forelse($reservations as $reservation)

                <div class="border-b py-3">

                    <p>

                        {{ $reservation->trajet->ville_depart }}

                        →

                        {{ $reservation->trajet->ville_arrivee }}

                    </p>

                    <p>

                        {{ \Carbon\Carbon::parse($reservation->trajet->horaire)->format('d/m/Y H:i') }}

                    </p>

                    <span class="font-semibold">

                        {{ ucfirst($reservation->statut) }}

                    </span>

                </div>

            @empty

                <p>Aucune réservation.</p>

            @endforelse

        </div>

    </div>

    <div class="mt-10 flex gap-4">

        <a href="{{ route('trajets.index') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded">

            Voir les trajets

        </a>

        <a href="{{ route('reservations.index') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded">

            Mes réservations

        </a>

    </div>

</div>

@endsection