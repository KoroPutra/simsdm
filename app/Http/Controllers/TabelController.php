<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use Carbon\Carbon;

use Illuminate\Http\Request;

class TabelController extends Controller
{
    public function index(){
        $konsultasi = Konsultasi::all();

        return view ('table', compact('konsultasi'));
    }
}
