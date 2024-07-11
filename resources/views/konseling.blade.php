<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('E-Konseling') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Form Konsultasi</h2>
                    <form id="konsultasiForm" action="{{ route('konsultasi.store') }}" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" id="name" name="name" value="{{ $nama }}" disabled class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="nip" class="block text-sm font-medium text-gray-700">NIP/NRP</label>
                            <input type="text" id="nip" name="nip" value="{{ $nips }}" disabled class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="unit_kerja" class="block text-sm font-medium text-gray-700">Unit Kerja</label>
                            <input type="text" id="unit_kerja" name="unit_kerja" value="{{ $untkerja }}" disabled class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="no_telpon" class="block text-sm font-medium text-gray-700">No HP</label>
                            <input type="text" id="no_telpon" name="no_telpon" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" id="judul" name="judul" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
                            <textarea id="pesan" name="pesan" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            <p>*Catatan : Konseli diharapkan melakukan pengecekan secara berkala pada fitur E-konseling SIMSDM untuk melihat respon dari tim E-konseling</p>
                        </div>
                        <div>
                            <button type="button" id="submitBtn" class="px-4 py-2 bg-indigo-600 block w-full text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#submitBtn').on('click', function(event) {
            event.preventDefault();
            var requiredFields = ['#email', '#no_telpon', '#judul', '#pesan'];
            var isValid = true;

            requiredFields.forEach(function(field) {
                if (!$(field).val()) {
                    $(field).addClass('border-red-500').focus();
                    isValid = false;
                    return false;
                } else {
                    $(field).removeClass('border-red-500');
                }
            });

            if (isValid) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan bisa mengubah data setelah submit!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, submit!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#konsultasiForm').submit();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Silakan isi semua field yang diperlukan!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Menangani pesan sukses setelah submit berhasil
        @if(session('success'))
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
        @endif

    </script>
</x-app-layout>
