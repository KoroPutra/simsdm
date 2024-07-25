<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Carbon\Carbon;

class Chat extends Component
{
    public User $user;
    public $message = '';

    public function sendMessage()
    {
        Message::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $this->user->id,
            'message' => $this->message,
        ]);

        $this->reset('message');
    }

    public function render()
    {
        $today = Carbon::today();

        return view('livewire.chat', [
            'user' => $this->user,
            'messages' => Message::where(function (Builder $query) use ($today) {
                $query->where('from_user_id', auth()->id())
                        ->where('to_user_id', $this->user->id)
                        ->whereDate('created_at', $today);
            })->orWhere(function (Builder $query) use ($today) {
                $query->where('from_user_id', $this->user->id)
                        ->where('to_user_id', auth()->id())
                        ->whereDate('created_at', $today);
            })
            ->get(),
        ]);
    }
}
