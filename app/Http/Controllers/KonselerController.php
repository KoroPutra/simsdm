<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KonselerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role != 2) {
            abort(403, 'Unauthorized action.');
        }

        $konsultasi = Konsultasi::where('konseler_id', $user->id)->get();

        return view('konseler-table', compact('konsultasi'));
    }
}
