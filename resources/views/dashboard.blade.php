<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Pesan dari Konseler') }}
                    </h2>
                    <div class="container mt-2">
                        @foreach ($users as $sender)
                            <span class="relative inline-flex mb-2">
                                <a href="{{ route('chat', $sender->id) }}" class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-sky-500 bg-white dark:bg-slate-800 transition ease-in-out duration-150  ring-1 ring-slate-900/10 dark:ring-slate-200/20"> 
                                    {{ $sender->name }}
                                </a>
                                <span id="notificationDot_{{ $sender->id }}" class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
                                </span>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('[id^="toggleButton_"]').forEach(function(button) {
            button.addEventListener('click', function() {
                var userId = this.getAttribute('data-user-id');
                var notificationDot = document.getElementById('notificationDot_' + userId);
                if (notificationDot) {
                    notificationDot.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
