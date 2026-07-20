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

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-6 py-3">Conducteur</th>
                    <th class="px-6 py-3">Départ</th>
                    <th class="px-6 py-3">Arrivée</th>
                    <th class="px-6 py-3">Horaire</th>
                    <th class="px-6 py-3">Statut</th>
                    <th class="px-6 py-3">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($reservations as $reservation)

                <tr class="border-b">

                    <td class="px-6 py-4">
                        {{ $reservation->trajet->conducteur->name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $reservation->trajet->ville_depart }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $reservation->trajet->ville_arrivee }}
                    </td>

                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($reservation->trajet->horaire)->format('d/m/Y H:i') }}
                    </td>

                    <td class="px-6 py-4">

                        @if($reservation->statut=='confirmee')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded">
                                Confirmée
                            </span>

                        @elseif($reservation->statut=='refusee')

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                                Refusée
                            </span>

                        @elseif($reservation->statut=='annulee')

                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded">
                                Annulée
                            </span>

                        @else

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                                En attente
                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex gap-2">

                            <a href="{{ route('reservations.show',$reservation->id) }}"
                               class="bg-green-600 text-white px-3 py-1 rounded">

                                Voir

                            </a>

                            <form action="{{ route('reservations.destroy',$reservation->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Annuler cette réservation ?')"
                                    class="bg-red-600 text-white px-3 py-1 rounded">

                                    Annuler

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center py-8">

                        Aucune réservation.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection