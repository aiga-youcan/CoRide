<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationStatusRequest;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Afficher les réservations du passager connecté.
     */
    public function index()
    {
        $reservations = Reservation::with('trajet')
            ->where('passager_id', Auth::id())
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $trajets = Trajet::all();

        return view('reservations.create', compact('trajets'));
    }

    /**
     * Enregistrer une réservation.
     */
    public function store(StoreReservationRequest $request)
{
    $trajet = Trajet::findOrFail($request->trajet_id);

    // Exemple résultat IA
    $result = "Compatible à 95%";

    Reservation::create([
        'trajet_id' => $trajet->id,
        'passager_id' => Auth::id(),
        'statut' => 'en_attente',
        'date_reservation' => now(),
        'ai_result' => $result,
    ]);

    return redirect()
        ->route('reservations.index')
        ->with('success', 'Réservation créée avec succès.');
}

    /**
     * Afficher une réservation.
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Modifier le statut.
     */
    public function update(UpdateReservationStatusRequest $request, Reservation $reservation)
    {
        $reservation->update([
            'statut' => $request->statut,
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Statut mis à jour.');
    }

    /**
     * Annuler une réservation.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Réservation supprimée.');
    }
}