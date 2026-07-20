@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-8">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-6">
            Modifier le statut
        </h2>

        <form action="{{ route('reservations.update',$reservation->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Statut
                </label>

                <select
                    name="statut"
                    class="w-full border rounded-lg px-4 py-2">

                    <option value="en_attente"
                        {{ $reservation->statut=='en_attente' ? 'selected' : '' }}>
                        En attente
                    </option>

                    <option value="confirmee"
                        {{ $reservation->statut=='confirmee' ? 'selected' : '' }}>
                        Confirmée
                    </option>

                    <option value="refusee"
                        {{ $reservation->statut=='refusee' ? 'selected' : '' }}>
                        Refusée
                    </option>

                    <option value="annulee"
                        {{ $reservation->statut=='annulee' ? 'selected' : '' }}>
                        Annulée
                    </option>

                </select>

            </div>

            <div class="flex justify-between">

                <a href="{{ route('reservations.index') }}"
                   class="bg-gray-500 text-white px-5 py-2 rounded">

                    Retour

                </a>

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">

                    Enregistrer

                </button>

            </div>

        </form>

    </div>

</div>

@endsection