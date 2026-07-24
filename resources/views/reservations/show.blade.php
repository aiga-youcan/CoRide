@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-3xl font-bold mb-6">Détails de la réservation</h2>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-gray-600">Conducteur</h3>
                <p>{{ $reservation->trajet->conducteur->name ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Passager</h3>
                <p>{{ $reservation->passager->name ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Ville de départ</h3>
                <p>{{ $reservation->trajet->ville_depart ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Ville d'arrivée</h3>
                <p>{{ $reservation->trajet->ville_arrivee ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Horaire</h3>
                <p>{{ $reservation->trajet->horaire ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-600">Date de réservation</h3>
                <p>{{ $reservation->date_reservation ? \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') : 'N/A' }}</p>
            </div>

            <div class="col-span-2">
                <h3 class="font-semibold text-gray-600">Statut</h3>
                @if($reservation->statut === 'confirmee')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded">✅ Confirmée</span>
                @elseif($reservation->statut === 'refusee')
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded">❌ Refusée</span>
                @elseif($reservation->statut === 'annulee')
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded">🚫 Annulée</span>
                @else
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">⏳ En attente</span>
                @endif
            </div>
        </div>

        {{-- Résultat IA --}}
        <div class="mt-8">
            <h3 class="text-xl font-bold mb-4">🤖 Résultat IA</h3>

            @if(is_null($reservation->ai_result))
                <div class="p-4 bg-gray-50 border border-gray-200 rounded">
                    Aucun résultat IA disponible.
                </div>
            @else
                @php
                    $ai = $reservation->ai_result;

                    // Defensive defaults
                    $score = isset($ai['score']) ? (int) $ai['score'] : 0;
                    $compatible = isset($ai['compatible']) ? (bool) $ai['compatible'] : false;
                    $niveau = $ai['niveau'] ?? null;
                    $justification = $ai['justification'] ?? null;
                    $horaire = $ai['horaire_suggere'] ?? null;
                @endphp

                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="w-full md:w-1/3 bg-white border rounded-lg shadow-sm p-6 text-center">
                        <div class="text-sm text-gray-500">Compatibilité</div>
                        <div class="mt-3 text-4xl font-extrabold {{ $score >= 75 ? 'text-green-600' : ($score >= 50 ? 'text-yellow-600' : 'text-red-600') }}">{{ $score }}%</div>
                        <div class="mt-2 text-sm text-gray-600">{{ $niveau ?? 'Niveau inconnu' }}</div>
                        <div class="mt-3">
                            @if($compatible)
                                <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded">Compatible</span>
                            @else
                                <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded">Non compatible</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex-1 bg-white border rounded-lg shadow-sm p-6">
                        <h4 class="font-semibold text-gray-700">Justification</h4>
                        <p class="mt-2 text-gray-600">{{ $justification ?? 'Aucune justification fournie.' }}</p>

                        <div class="mt-4">
                            <h5 class="font-semibold text-gray-700">Horaire suggéré</h5>
                            <p class="mt-1 text-gray-600">{{ $horaire ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-8 flex justify-between items-center">
            <a href="{{ route('reservations.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">Retour</a>

            <div>
                <h3 class="font-semibold mb-3">Modifier le statut</h3>
                <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    @method('PUT')
                    <select name="statut" class="border rounded-lg px-4 py-2">
                        <option value="en_attente" {{ $reservation->statut === 'en_attente' ? 'selected' : '' }}>⏳ En attente</option>
                        <option value="confirmee" {{ $reservation->statut === 'confirmee' ? 'selected' : '' }}>✅ Confirmée</option>
                        <option value="refusee" {{ $reservation->statut === 'refusee' ? 'selected' : '' }}>❌ Refusée</option>
                        <option value="annulee" {{ $reservation->statut === 'annulee' ? 'selected' : '' }}>🚫 Annulée</option>
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection