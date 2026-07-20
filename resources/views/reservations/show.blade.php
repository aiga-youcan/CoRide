@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto mt-8">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h2 class="text-3xl font-bold mb-6">
            Détails de la réservation
        </h2>

        <div class="grid grid-cols-2 gap-6">

            <div>
                <h3 class="font-semibold text-gray-600">Conducteur</h3>
                <p>{{ $reservation->trajet->conducteur->name }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Passager</h3>
                <p>{{ $reservation->passager->name }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Ville de départ</h3>
                <p>{{ $reservation->trajet->ville_depart }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Ville d'arrivée</h3>
                <p>{{ $reservation->trajet->ville_arrivee }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Horaire</h3>
                <p>
                    {{ \Carbon\Carbon::parse($reservation->trajet->horaire)->format('d/m/Y H:i') }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Date de réservation</h3>
                <p>
                    {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                </p>
            </div>

            <div class="col-span-2">
                <h3 class="font-semibold text-gray-600">Statut</h3>

                @if($reservation->statut=='confirmee')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded">
                        Confirmée
                    </span>

                @elseif($reservation->statut=='refusee')
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                        Refusée
                    </span>

                @elseif($reservation->statut=='annulee')
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded">
                        Annulée
                    </span>

                @else
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                        En attente
                    </span>
                @endif

            </div>

        </div>

        {{-- Résultat IA --}}
        @if(!empty($reservation->ai_result))

        <div class="mt-8 bg-blue-50 border border-blue-300 rounded-lg p-5">

            <h3 class="text-xl font-bold mb-4">
                Compatibilité IA
            </h3>

            <div class="space-y-3">

                <p>
                    <strong>Score :</strong>
                    {{ $reservation->ai_result['score'] }}/100
                </p>

                <p>
                    <strong>Justification :</strong>
                    {{ $reservation->ai_result['justification'] }}
                </p>

                <p>
                    <strong>Horaire suggéré :</strong>
                    {{ $reservation->ai_result['horaire_suggere'] }}
                </p>

            </div>

        </div>

        @endif

        <div class="mt-8 flex justify-between">

            <a href="{{ route('reservations.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded">

                Retour

            </a>

            <a href="{{ route('reservations.edit',$reservation->id) }}"
               class="bg-yellow-500 text-white px-5 py-2 rounded">

                Modifier

            </a>

        </div>

    </div>

</div>

@endsection