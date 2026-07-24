@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">
            Liste des trajets
        </h1>

        <a href="{{ route('trajets.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Nouveau trajet
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
                    <th class="px-6 py-3 text-left">Conducteur</th>
                    <th class="px-6 py-3 text-left">Départ</th>
                    <th class="px-6 py-3 text-left">Arrivée</th>
                    <th class="px-6 py-3 text-left">Horaire</th>
                    <th class="px-6 py-3 text-center">Places</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($trajets as $trajet)

                <tr class="border-b">

                    <td class="px-6 py-4">
                        {{ $trajet->conducteur->name ?? 'N/A' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $trajet->ville_depart }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $trajet->ville_arrivee }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $trajet->horaire }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ $trajet->places_disponibles }}
                    </td>

                    <td class="px-6 py-4">

                        <div class="flex gap-2 justify-center">

                            <a href="{{ route('trajets.show', $trajet->id) }}"
                               class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                Voir
                            </a>

                            <a href="{{ route('trajets.edit', $trajet->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                Modifier
                            </a>

                            <form action="{{ route('trajets.destroy', $trajet->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Supprimer ce trajet ?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Supprimer
                                </button>
                            </form>

                            <a href="{{ route('reservations.create', ['trajet' => $trajet->id]) }}"
                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded">
                                Réserver
                            </a>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center py-6">
                        Aucun trajet disponible.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection