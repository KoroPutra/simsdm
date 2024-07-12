<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;

class TabelController extends Controller
{
    public function index(){
        $konsultasi = Konsultasi::orderBy('id', 'desc')->get();
        $users = User::where('id', '!=', auth()->id())->get();
        $konselors = User::where('role', 2)->get();

        return view ('table', compact('konsultasi', 'konselors', 'users'));
    }
}
