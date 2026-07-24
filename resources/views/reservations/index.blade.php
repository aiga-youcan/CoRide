@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto mt-8">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-3xl font-bold">
            Mes réservations
        </h2>

        <a href="{{ route('trajets.index') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

            Réserver un trajet

        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
            {{ session('success') }}
        </div>

    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-6 py-3 text-left">Conducteur</th>
                    <th class="px-6 py-3 text-left">Départ</th>
                    <th class="px-6 py-3 text-left">Arrivée</th>
                    <th class="px-6 py-3 text-left">Horaire</th>
                    <th class="px-6 py-3 text-center">Statut</th>
                    <th class="px-6 py-3 text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

@forelse($reservations as $reservation)

<tr class="border-b hover:bg-gray-50">

    <td class="px-6 py-4 text-left">
        {{ $reservation->trajet->conducteur->name ?? 'N/A' }}
    </td>

    <td class="px-6 py-4 text-left">
        {{ $reservation->trajet->ville_depart ?? 'N/A' }}
    </td>

    <td class="px-6 py-4 text-left">
        {{ $reservation->trajet->ville_arrivee ?? 'N/A' }}
    </td>

    <td class="px-6 py-4 text-left">
        {{ $reservation->trajet->horaire ?? 'N/A' }}
    </td>

    <td class="px-6 py-4 text-center">
        @if($reservation->statut === 'confirmee')
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                Confirmée
            </span>
        @elseif($reservation->statut === 'refusee')
            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                Refusée
            </span>
        @elseif($reservation->statut === 'annulee')
            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                Annulée
            </span>
        @else
            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                En attente
            </span>
        @endif
    </td>

    <td class="px-6 py-4 text-center">
        <a href="{{ route('reservations.show', $reservation->id) }}"
           class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">
            Voir
        </a>
    </td>

</tr>

@empty

<tr>
    <td colspan="6" class="px-6 py-5 text-center text-gray-500">
        Aucune réservation trouvée
    </td>
</tr>

@endforelse

</tbody>

        </table>

    </div>

</div>

@endsection