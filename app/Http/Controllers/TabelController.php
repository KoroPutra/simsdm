<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TabelController extends Controller
{
    public function index()
    {
        $konsultasi = Konsultasi::with('konseler')
            ->select('konsultasi.*', DB::raw('(
                SELECT MAX(updated_at) FROM messages 
                WHERE (messages.from_user_id = konsultasi.konseler_id AND messages.to_user_id = konsultasi.user_id) 
                OR (messages.from_user_id = konsultasi.user_id AND messages.to_user_id = konsultasi.konseler_id)
            ) as last_message_updated_at'))
            ->orderBy('id', 'desc')
            ->get();

        $users = User::where('id', '!=', auth()->id())->get();
        $konselors = User::where('role', 2)->get();

        return view('table', compact('konsultasi', 'konselors', 'users'));
    }

    public function assignKonseler(Request $request, Konsultasi $konsultasi)
    {
        $konsultasi->konseler_id = $request->input('konseler_id');
        $konsultasi->save();

        return redirect()->back()->with('success', 'Konsultasi ditugaskan');
    }
}
