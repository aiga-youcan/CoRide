@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-8">

    <div class="bg-white shadow rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-6">
            Ajouter un trajet
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

        <form action="{{ route('trajets.store') }}" method="POST">

            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Ville de départ
                </label>

                <select name="ville_depart" class="w-full border rounded-lg px-4 py-2" required>
                    <option value="">-- Choisir une ville --</option>
                    @foreach($villes as $ville)
                        <option value="{{ $ville->nom }}" {{ old('ville_depart') == $ville->nom ? 'selected' : '' }}>
                            {{ $ville->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Ville d'arrivée
                </label>

                <select name="ville_arrivee" class="w-full border rounded-lg px-4 py-2" required>
                    <option value="">-- Choisir une ville --</option>
                    @foreach($villes as $ville)
                        <option value="{{ $ville->nom }}" {{ old('ville_arrivee') == $ville->nom ? 'selected' : '' }}>
                            {{ $ville->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Horaire
                </label>

                <input type="time" name="horaire" value="{{ old('horaire', '08:00') }}" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Nombre de places
                </label>

                <input type="number" name="places_disponibles" min="1" value="{{ old('places_disponibles', 1) }}" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-3">
                    Jours de récurrence
                </label>

                @php
                    $jours = [
                        'Lundi',
                        'Mardi',
                        'Mercredi',
                        'Jeudi',
                        'Vendredi',
                        'Samedi',
                        'Dimanche'
                    ];
                @endphp

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach($jours as $jour)
                        <label class="flex items-center gap-2 border rounded-lg px-4 py-3 hover:bg-blue-50 cursor-pointer">
                            <input type="checkbox" name="jours_recurrence[]" value="{{ $jour }}" {{ in_array($jour, old('jours_recurrence', [])) ? 'checked' : '' }}>
                            <span>{{ $jour }}</span>
                        </label>
                    @endforeach
                </div>

            </div>

            <div class="flex justify-between">
                <a href="{{ route('trajets.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                    Retour
                </a>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                    Enregistrer
                </button>
            </div>

        </form>

    </div>

</div>

@endsection