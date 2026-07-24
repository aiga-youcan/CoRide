<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrajetRequest;
use App\Http\Requests\UpdateTrajetRequest;
use App\Models\Trajet;
use App\Models\Ville;
use Illuminate\Support\Facades\Auth;

class TrajetController extends Controller
{
    /**
     * Afficher tous les trajets.
     */
    public function index()
    {
        $trajets = Trajet::with('conducteur')->get();

        return view('trajets.index', compact('trajets'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        $villes = Ville::all();

        return view('trajets.create', compact('villes'));
    }

    /**
     * Enregistrer un trajet.
     */
    public function store(StoreTrajetRequest $request)
    {
        $jours = is_array($request->jours_recurrence)
            ? implode(', ', $request->jours_recurrence)
            : $request->jours_recurrence;

        Trajet::create([
            'conducteur_id' => Auth::id(),
            'ville_depart' => $request->ville_depart,
            'ville_arrivee' => $request->ville_arrivee,
            'horaire' => $request->horaire,
            'places_disponibles' => $request->places_disponibles,
            'jours_recurrence' => $jours,
        ]);

        return redirect()
            ->route('trajets.index')
            ->with('success', 'Trajet créé avec succès.');
    }

    /**
     * Afficher le détail d'un trajet.
     */
    public function show(Trajet $trajet)
    {
        $trajet->load(['conducteur', 'reservations.passager']);

        return view('trajets.show', compact('trajet'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit(Trajet $trajet)
    {
        $villes = Ville::all();

        return view('trajets.edit', compact('trajet', 'villes'));
    }

    /**
     * Mettre à jour un trajet.
     */
    public function update(UpdateTrajetRequest $request, Trajet $trajet)
    {
        $jours = is_array($request->jours_recurrence)
            ? implode(', ', $request->jours_recurrence)
            : $request->jours_recurrence;

        $trajet->update([
            'ville_depart' => $request->ville_depart,
            'ville_arrivee' => $request->ville_arrivee,
            'horaire' => $request->horaire,
            'places_disponibles' => $request->places_disponibles,
            'jours_recurrence' => $jours,
        ]);

        return redirect()
            ->route('trajets.index')
            ->with('success', 'Trajet mis à jour.');
    }

    /**
     * Supprimer un trajet.
     */
    public function destroy(Trajet $trajet)
    {
        $trajet->delete();

        return redirect()
            ->route('trajets.index')
            ->with('success', 'Trajet supprimé.');
    }
}
