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
