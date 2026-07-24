<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'trajet_id' => 'required|exists:trajets,id',
            'ville_depart_passager' => 'required|string',
            'ville_arrivee_passager' => 'required|string',
            'horaire_passager' => 'required|string',
            'jours_passager' => 'required|string',
            'statut' => 'nullable|in:en_attente,confirmee,refusee,annulee',
        ];
    }
}
