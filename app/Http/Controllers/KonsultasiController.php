<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        return view('konsultasi.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'no_telpon' => 'required',
            'judul' => 'required',
            'pesan' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $konsultasi = Konsultasi::create([
            'user_id' => $request->user_id,
            'email' => $request->email,
            'no_telpon' => $request->no_telpon,
            'judul' => $request->judul,
            'pesan' => $request->pesan,
        ]);

        Message::create([
            'from_user_id' => auth()->id(),
            'message' => $request->pesan,
            'konsultasi_id' => $konsultasi->id,
        ]);

        return redirect()->route('chat', ['konsultasi_id' => $konsultasi->id])
                        ->with('success', 'Konsultasi berhasil dikirim!');
    }

    public function getUserId()
    {
        $id = Auth::user()->id;
        $nama = Auth::user()->name;
        $nips = Auth::user()->nip;
        $untkerja = Auth::user()->unit_kerja;
        return view('konseling', compact('id', 'nama', 'nips', 'untkerja'));
    }
}
