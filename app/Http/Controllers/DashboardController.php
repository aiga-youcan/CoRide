<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $trajets = Trajet::where('conducteur_id', $user->id)->get();

        $reservations = Reservation::where('passager_id', $user->id)->get();

        return view('dashboard', compact('trajets', 'reservations'));
    }
}