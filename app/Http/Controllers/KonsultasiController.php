<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class KonsultasiController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        return view('consultations.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        \App\Models\Konsultasi::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('consultations.create')->with('success', 'Konsultasi berhasil dikirim!');
    }

    public function getUserId()
    {
        $nama = Auth::user()->name;
        $nips = Auth::user()->nip;
        $untkerja = Auth::user()->unit_kerja;
        return view('konseling', compact('nama', 'nips', 'untkerja'));
    }
}
