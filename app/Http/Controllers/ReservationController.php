<?php

namespace App\Http\Controllers;

use App\Agents\MatchingAgent;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationStatusRequest;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\Ville;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Afficher les réservations du passager connecté.
     */
    public function index()
    {
        $reservations = Reservation::with([
            'trajet.conducteur',
            'passager',
        ])
            ->where('passager_id', Auth::id())
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $trajets = Trajet::with('conducteur')->get();
        $villes = Ville::all();

        return view('reservations.create', compact('trajets', 'villes'));
    }

    /**
     * Enregistrer une réservation.
     */
    public function store(StoreReservationRequest $request)
    {
        $trajet = Trajet::findOrFail($request->trajet_id);

        // Vérification 1 : Pas de double réservation
        $alreadyReserved = Reservation::where('trajet_id', $trajet->id)
            ->where('passager_id', Auth::id())
            ->exists();

        if ($alreadyReserved) {
            return back()->withErrors(['trajet_id' => 'Vous avez déjà réservé ce trajet.'])->withInput();
        }

        // Vérification 2 : Places disponibles
        if ($trajet->places_disponibles <= 0) {
            return back()->withErrors(['trajet_id' => 'Aucune place disponible sur ce trajet.'])->withInput();
        }

        // Calcul IA (côté passager)
        $agent = new MatchingAgent;
        $aiResult = $agent->analyze([
            'ville_depart_conducteur' => $trajet->ville_depart,
            'ville_arrivee_conducteur' => $trajet->ville_arrivee,
            'horaire_conducteur' => $trajet->horaire,
            'jours_conducteur' => $trajet->jours_recurrence,

            'ville_depart_passager' => $request->ville_depart_passager,
            'ville_arrivee_passager' => $request->ville_arrivee_passager,
            'horaire_passager' => $request->horaire_passager,
            'jours_passager' => $request->jours_passager,
        ]);

        Reservation::create([
            'trajet_id' => $trajet->id,
            'passager_id' => Auth::id(),
            'statut' => 'en_attente',
            'date_reservation' => now()->toDateString(),
            'ai_result' => $aiResult,
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
        $reservation->load(['trajet.conducteur', 'passager']);

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
            ->with('success', 'Statut modifié avec succès.');
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
