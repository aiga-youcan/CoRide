@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto mt-8">

    <div class="bg-white shadow-lg rounded-lg p-8">

        <h2 class="text-3xl font-bold mb-6">
            Détails du trajet
        </h2>

        <div class="grid grid-cols-2 gap-6">

            <div>
                <h3 class="font-semibold text-gray-600">
                    Conducteur
                </h3>

                <p class="text-lg">
                    {{ $trajet->conducteur->name ?? 'N/A' }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">
                    Email
                </h3>

                <p class="text-lg">
                    {{ $trajet->conducteur->email ?? 'N/A' }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">
                    Ville de départ
                </h3>

                <p class="text-lg">
                    {{ $trajet->ville_depart }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">
                    Ville d'arrivée
                </h3>

                <p class="text-lg">
                    {{ $trajet->ville_arrivee }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">
                    Horaire
                </h3>

                <p class="text-lg">
                    {{ $trajet->horaire }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">
                    Places disponibles
                </h3>

                <p class="text-lg">
                    {{ $trajet->places_disponibles }}
                </p>
            </div>

            <div class="col-span-2">
                <h3 class="font-semibold text-gray-600">
                    Jours de récurrence
                </h3>

                <p class="text-lg">
                    {{ $trajet->jours_recurrence }}
                </p>
            </div>

        </div>

        <hr class="my-8">

        <h3 class="text-2xl font-bold mb-4">
            Réservations
        </h3>

        @if($trajet->reservations->count())

            <table class="min-w-full border">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="border px-4 py-2 text-left">Passager</th>
                        <th class="border px-4 py-2 text-center">Statut</th>
                        <th class="border px-4 py-2 text-center">Date</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($trajet->reservations as $reservation)

                        <tr>

                            <td class="border px-4 py-2 text-left">
                                {{ $reservation->passager->name ?? 'N/A' }}
                            </td>

                            <td class="border px-4 py-2 text-center">
                                {{ ucfirst($reservation->statut) }}
                            </td>

                            <td class="border px-4 py-2 text-center">
                                {{ $reservation->date_reservation ? \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') : 'N/A' }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <p class="text-gray-500">
                Aucune réservation.
            </p>

        @endif

        <div class="mt-8 flex justify-between">

            <a href="{{ route('trajets.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                Retour

            </a>

            <a href="{{ route('trajets.edit', $trajet->id) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

                Modifier

            </a>

        </div>

    </div>

</div>

@endsection