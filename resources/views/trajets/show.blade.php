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
                    {{ $trajet->conducteur->name }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">
                    Email
                </h3>

                <p class="text-lg">
                    {{ $trajet->conducteur->email }}
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
                    {{ \Carbon\Carbon::parse($trajet->horaire)->format('d/m/Y H:i') }}
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

                        <th class="border px-4 py-2">Passager</th>
                        <th class="border px-4 py-2">Statut</th>
                        <th class="border px-4 py-2">Date</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($trajet->reservations as $reservation)

                        <tr>

                            <td class="border px-4 py-2">
                                {{ $reservation->passager->name }}
                            </td>

                            <td class="border px-4 py-2">
                                {{ ucfirst($reservation->statut) }}
                            </td>

                            <td class="border px-4 py-2">
                                {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
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

        <hr class="my-8">

        {{-- Partie IA --}}
        @if(isset($reservation) && $reservation->ai_result)

            <div class="bg-blue-50 border border-blue-300 rounded-lg p-5">

                <h3 class="text-xl font-bold mb-4">
                    Compatibilité IA
                </h3>

                <p>
                    <strong>Score :</strong>
                    {{ $reservation->ai_result['score'] }}/100
                </p>

                <p class="mt-2">
                    <strong>Justification :</strong>
                    {{ $reservation->ai_result['justification'] }}
                </p>

                <p class="mt-2">
                    <strong>Horaire suggéré :</strong>
                    {{ $reservation->ai_result['horaire_suggere'] }}
                </p>

            </div>

        @endif

        <div class="mt-8 flex justify-between">

            <a href="{{ route('trajets.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded">

                Retour

            </a>

            <a href="{{ route('trajets.edit',$trajet->id) }}"
               class="bg-yellow-500 text-white px-5 py-2 rounded">

                Modifier

            </a>

        </div>

    </div>

</div>

@endsection