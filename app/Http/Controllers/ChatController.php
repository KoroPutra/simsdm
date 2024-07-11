<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChatController extends Controller
{
    public function show(User $user)
    {
        // Pass the user to the chat view
        return view('chat', compact('user'));
    }
}

