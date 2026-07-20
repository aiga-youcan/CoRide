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
            'statut' => 'nullable|in:en_attente,confirmee,refusee,annulee',
        ];
    }
}