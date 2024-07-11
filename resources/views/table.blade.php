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
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $item->id }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $item->judul }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"></td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <select class="p-2 border border-gray-300 rounded w-full">
                                        <option value="" disabled selected>Pilih Konseler</option>
                                        <option value="konseler 1" >Konseler 1</option>
                                        <option value="konseler 2" >Konseler 2</option>
                                    </select>
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded">Simpan</button>
                                    <a href="{{ route('chat', $item->user_id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded">Mulai Percakapan</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
