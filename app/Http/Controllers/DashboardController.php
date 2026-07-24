<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $trajets = Trajet::where('conducteur_id', $user->id)->get();

        $reservations = Reservation::with(['trajet.conducteur'])
            ->where('passager_id', $user->id)
            ->get();

        return view('dashboard', compact('trajets', 'reservations'));
    }
}
