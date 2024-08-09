<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ruang Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-y-auto h-96" wire:poll>
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                </div>
                            </div>
                            <div class="chat-header">
                                System
                            </div>
                            <div class="chat-bubble chat-bubble-primary">
                                Selamat datang diruang chat. Silahkan menunggu admin dan konseler masuk keruangan. Terimakasih !!
                            </div>
                            <div class="chat-footer opacity-50">Delivered</div>
                        </div>
                        @foreach ($messages as $message)
                        <div class="chat @if ($message->from_user_id == auth()->id()) chat-end @else chat-start @endif">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header">
                                {{ $message->fromUser->name }}
                                <time class="text-xs opacity-50">{{ $message->created_at->diffForHumans() }}</time>
                            </div>
                            <div class="chat-bubble">{{ $message->message }}</div>
                            <div class="chat-footer opacity-50">Delivered</div>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-control">
                        <form wire:submit.prevent="sendMessage">
                            <textarea class="textarea textarea-bordered w-full bg-gray-200 my-2" rows="2" wire:model="message" placeholder="Ketik pesan disini ..."></textarea>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('chat-room-loaded', event => {
        Swal.fire({
            title: 'Selamat datang!',
            text: 'Selamat datang diruang perbincangan. Silahkan menunggu admin dan konseler masuk keruangan. Terimakasih!!',
            icon: 'info',
            confirmButtonText: 'OK'
        });
    });
</script>
