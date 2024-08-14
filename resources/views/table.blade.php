<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabel Konseling') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full border-collapse block md:table">
                        <thead class="block md:table-header-group">
                            <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">No Tiket</th>
                                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Judul </th>
                                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Tgl Awal Konsultasi</th>
                                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Tgl Terakhir Konsultasi</th>
                                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Konseler</th>
                                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @foreach ($konsultasi as $item)
                            <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-grey-500 text-left text-black block md:table-cell">{{ $item->id }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left text-black block md:table-cell">{{ $item->judul }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left text-black block md:table-cell">{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left text-black block md:table-cell">{{ $item->last_message_updated_at ? date('d F Y', strtotime($item->last_message_updated_at)) : '' }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left text-black block md:table-cell">
                                    {{ $item->konseler ? $item->konseler->name : 'Belum Ditentukan' }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 border border-yellow-500 rounded" 
                                            onclick="showUpdateModal('{{ route('konsultasi.assignKonseler', $item->id) }}', '{{ $item->konseler_id }}', '{{ $item->jadwal }}')">
                                        Edit
                                    </button>
                                    <a href="{{ route('chat', ['konsultasi_id' => $item->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded">Mulai Percakapan</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $konsultasi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="updateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-1/4 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Update Konseler & Jadwal</h3>
                <form id="updateForm" method="POST">
                    @csrf
                    <div class="mt-2">
                        <label for="konseler_id" class="block text-left">Konseler</label>
                        <select name="konseler_id" id="konseler_id" class="p-2 border border-gray-300 rounded w-full" required>
                            <option value="" disabled selected>Pilih Konseler</option>
                            @foreach ($konselors as $konseler)
                                <option value="{{ $konseler->id }}">{{ $konseler->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="jadwal" class="block text-left">Jadwal</label>
                        <input type="datetime-local" name="jadwal" id="jadwal" class="p-2 border border-gray-300 rounded w-full" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                        <button type="button" id="cancelButton" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:navigated', function () {
            const modal = document.getElementById('updateModal');
            const cancelButton = document.getElementById('cancelButton');
            const form = document.getElementById('updateForm');

            function showModal(actionUrl, konselerId, jadwal) {
                form.action = actionUrl;
                document.getElementById('konseler_id').value = konselerId;
                document.getElementById('jadwal').value = jadwal ? jadwal.replace(' ', 'T') : '';
                modal.classList.remove('hidden');
            }

            function hideModal() {
                modal.classList.add('hidden');
            }

            cancelButton.addEventListener('click', function () {
                hideModal();
            });

            window.showUpdateModal = showModal;
        });
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Data Telah Diperbaharui',
            text: '{{ session('success') }}',
        });
        @endif
    </script>
</x-app-layout>
