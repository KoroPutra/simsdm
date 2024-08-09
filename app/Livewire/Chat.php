<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\Konsultasi;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Carbon\Carbon;

class Chat extends Component
{
    public $message = '';
    public Konsultasi $konsultasi;
    public $konsultasi_id;

    public function mount($konsultasi_id)
    {
        $this->konsultasi_id = $konsultasi_id;
        $this->user = auth()->user();
        $this->dispatch('chat-room-loaded');
    }

    public function sendMessage()
    {
        Message::create([
            'from_user_id' => auth()->id(),
            'message' => $this->message,
            'konsultasi_id' => $this->konsultasi_id,
        ]);

        $this->reset('message');
    }

    public function render()
    {
        $today = Carbon::today();

        return view('livewire.chat', [
            'messages' => Message::where('konsultasi_id', $this->konsultasi_id)
                                ->whereDate('created_at', $today)
                                ->orderBy('created_at', 'asc')
                                ->get(),
        ]);
    }
}

