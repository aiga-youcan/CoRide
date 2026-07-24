@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-8">

<div class="bg-white shadow-lg rounded-lg p-6">

<h2 class="text-2xl font-bold mb-6">
Réserver un trajet
</h2>

<form action="{{ route('reservations.store') }}" method="POST">

@csrf


<div class="mb-5">
<label class="block font-semibold mb-2">
Choisir un trajet
</label>

<select name="trajet_id" class="w-full border rounded-lg px-4 py-2" required>

<option value="">
-- Sélectionner un trajet --
</option>

@foreach($trajets as $trajet)

<option value="{{ $trajet->id }}">
{{ $trajet->ville_depart }} → {{ $trajet->ville_arrivee }} | {{ $trajet->horaire }}
</option>

@endforeach

</select>

</div>



<div class="mb-5">

<label class="block font-semibold mb-2">
Votre ville de départ
</label>

<select name="ville_depart_passager"
class="w-full border rounded-lg px-4 py-2"
required>

<option value="">
-- Choisir --
</option>

@foreach($villes as $ville)

<option value="{{ $ville->nom }}">
{{ $ville->nom }}
</option>

@endforeach

</select>

</div>



<div class="mb-5">

<label class="block font-semibold mb-2">
Votre ville d'arrivée
</label>

<select name="ville_arrivee_passager"
class="w-full border rounded-lg px-4 py-2"
required>

<option value="">
-- Choisir --
</option>

@foreach($villes as $ville)

<option value="{{ $ville->nom }}">
{{ $ville->nom }}
</option>

@endforeach

</select>

</div>



<div class="mb-5">

<label class="block font-semibold mb-2">
Votre horaire
</label>

<input 
type="time"
name="horaire_passager"
class="w-full border rounded-lg px-4 py-2"
required>

</div>



<div class="mb-5">

<label class="block font-semibold mb-2">
Jour
</label>


<select name="jours_passager"
class="w-full border rounded-lg px-4 py-2"
required>

<option value="">
-- Choisir --
</option>

<option>Lundi</option>
<option>Mardi</option>
<option>Mercredi</option>
<option>Jeudi</option>
<option>Vendredi</option>
<option>Samedi</option>
<option>Dimanche</option>

</select>

</div>



<div class="flex justify-between">

<a href="{{ route('reservations.index') }}"
class="bg-gray-500 text-white px-5 py-2 rounded">

Retour

</a>


<button
class="bg-blue-600 text-white px-5 py-2 rounded">

Réserver

</button>

</div>


</form>

</div>

</div>

@endsection