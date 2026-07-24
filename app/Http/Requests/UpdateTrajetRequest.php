<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrajetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'ville_depart' => 'required|string|max:100|exists:villes,nom',
            'ville_arrivee' => 'required|string|max:100|different:ville_depart|exists:villes,nom',
            'horaire' => 'required|string',
            'places_disponibles' => 'required|integer|min:1',
            'jours_recurrence' => 'required',
        ];
    }
}
