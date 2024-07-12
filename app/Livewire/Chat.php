<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Models\Konsultasi;

class Chat extends Component
{

    public User $user;
    public $message = '';

    public function sendMessage()
    {
        dd($this->user->id);
        Message::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $this->user->id,
            'message' => $this->message,
        ]);
        
    }
    public function render()
    {
        return view('livewire.chat',[
            'user'=> $this->user
        ]);
    }


}
