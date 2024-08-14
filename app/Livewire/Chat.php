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
        $this->konsultasi = Konsultasi::findOrFail($konsultasi_id);
        $today = Carbon::now()->toDateString(); // Current date
        $scheduledDate = $this->konsultasi->jadwal ? Carbon::parse($this->konsultasi->jadwal)->toDateString() : null; // Scheduled date or null

// Check if the scheduled date is today, if it's null, or if the status is 0
        if ($scheduledDate === null || $today !== $scheduledDate || $this->konsultasi->status == 0) {
            $role = auth()->user()->role;

            if ($role == 1) {
                return redirect()->route('admin')->with('error', 'Chat room admin tidak dapat diakses');
            } elseif ($role == 2) {
                return redirect()->route('konseler')->with('error', 'Chat room konseler tidak dapat diakses');
            } elseif ($role == 3) {
                return redirect()->route('dashboard')->with('error', 'Chat room user tidak dapat diakses');
            }
    
        }
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

        return view('livewire.chat', [
            'messages' => Message::where('konsultasi_id', $this->konsultasi_id)
                                ->orderBy('created_at', 'asc')
                                ->get(),
        ]);
    }
}

