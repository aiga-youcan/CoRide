@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-6">
            Mon Profil
        </h2>

        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-6">
            Modifier le mot de passe
        </h2>

        @include('profile.partials.update-password-form')
    </div>

    <div class="bg-white shadow rounded-xl p-6 border border-red-200">
        <h2 class="text-2xl font-bold text-red-600 mb-6">
            Supprimer le compte
        </h2>

        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection