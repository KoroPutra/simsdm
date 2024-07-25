<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $authUserId = Auth::id();
        $role = Auth::user()->role;
        $today = Carbon::today();

        if ($role == 2 || $role == 3) {
            // Fetch only the authenticated user's consultations if they are a regular user or konselor
            $konsultasi = Konsultasi::where('user_id', $authUserId)
                ->orderBy('id', 'desc')
                ->whereDate('created_at', $today)
                ->get();
        } else {
            // Optionally, handle other roles or throw an error/redirect
            abort(403, 'Unauthorized action.');
        }

        return view('user', compact('konsultasi'));
    }

    public function pesanMasuk()
    {
        $user = Auth::user();

        if ($user->role != 3) { // Ensure the user is a regular user
            abort(403, 'Unauthorized action.');
        }

        $today = Carbon::today();

        $users = User::whereIn('id', function ($query) use ($user, $today) {
            $query->select('from_user_id')
                ->from('messages')
                ->where('to_user_id', $user->id)
                ->whereDate('created_at', $today)
                ->distinct();
        })->get();

        return view('dashboard', compact('users', 'user'));
    }
}
