@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-8">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-6">
            Réserver un trajet
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

        <form action="{{ route('reservations.store') }}" method="POST">

            @csrf

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Choisir un trajet
                </label>

                <select
                    name="trajet_id"
                    class="w-full border rounded-lg px-4 py-2"
                    required>

                    <option value="">-- Sélectionner un trajet --</option>

                    @foreach($trajets as $trajet)

                        <option value="{{ $trajet->id }}">

                            {{ $trajet->ville_depart }}
                            →
                            {{ $trajet->ville_arrivee }}

                            |

                            {{ \Carbon\Carbon::parse($trajet->horaire)->format('d/m/Y H:i') }}

                            |

                            {{ $trajet->conducteur->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="flex justify-between">

                <a href="{{ route('reservations.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                    Retour

                </a>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                    Réserver

                </button>

            </div>

        </form>

    </div>

</div>

@endsection