@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-8">

    <div class="bg-white shadow rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-6">
            Modifier un trajet
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('trajets.update', $trajet->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Ville de départ
                </label>

                <input
                    type="text"
                    name="ville_depart"
                    value="{{ old('ville_depart', $trajet->ville_depart) }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Ville d'arrivée
                </label>

                <input
                    type="text"
                    name="ville_arrivee"
                    value="{{ old('ville_arrivee', $trajet->ville_arrivee) }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Horaire
                </label>

                <input
                    type="datetime-local"
                    name="horaire"
                    value="{{ old('horaire', \Carbon\Carbon::parse($trajet->horaire)->format('Y-m-d\TH:i')) }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Places disponibles
                </label>

                <input
                    type="number"
                    name="places_disponibles"
                    min="1"
                    value="{{ old('places_disponibles', $trajet->places_disponibles) }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Jours de récurrence
                </label>

                <input
                    type="text"
                    name="jours_recurrence"
                    value="{{ old('jours_recurrence', $trajet->jours_recurrence) }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
            </div>

            <div class="flex justify-between">

                <a href="{{ route('trajets.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                    Retour

                </a>

                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

                    Mettre à jour

                </button>

            </div>

        </form>

    </div>

</div>

@endsection