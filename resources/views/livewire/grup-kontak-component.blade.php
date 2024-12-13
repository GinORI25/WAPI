<div>

    <div class="w-full mx-auto bg-white p-5 rounded-lg shadow-lg mt-6">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-2xl font-bold">LIST GRUP</h2>
            <button class="bg-black text-white px-4 py-2 rounded-lg" wire:click="tambahgrup">Tambah list
                grup</button>
        </div>
        <div class="mb-6">
            <input type="text" id="katakunci" wire:model.live="katakunci" placeholder="Cari Grup"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border-b-2 p-2">No</th>
                    <th class="border-b-2 p-2">Nama Grup</th>
                    <th class="border-b-2 p-2">Jumlah Kontak</th>
                    <th class="border-b-2 p-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dataGrup as $index => $grup)
                    <tr class="bg-gray-100">
                        <td class="border-b p-2 text-center">{{ $dataGrup->firstItem() + $index }}</td>
                        <td class="border-b p-2 text-center">{{ $grup->nama_grup }}</td>
                        <td class="border-b p-2 text-center">{{ $grup->jumlah_kontak }}</td>
                        <td class="border-b p-2 text-center">
                            <!-- Edit Button -->
                            <button wire:click="editgrup({{ $grup->id }})"
                                class="text-green-600 hover:text-green-800">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                    <path
                                        d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                </svg>
                            </button>
                            <!-- Delete Button -->
                            <button wire:click="confirmdelete({{ $grup->id }})"
                                class="text-red-600 hover:text-red-800">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    {{ $dataGrup->links() }}




    @if ($isGrupVisible)
        <div id="tamKon" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-3/4">
                <h3 id="judul" name="judul" class="text-lg font-semibold mb-4 text-center text-green-600">
                    @if ($grup_id)
                        Edit Grup
                    @else
                        Tambah Grup
                    @endif
                </h3>

                <!-- Input Nama Grup -->
                <div class="mb-6">
                    <label for="nama_grup" class="block text-sm font-medium text-gray-700">Nama Grup</label>
                    <input type="text" wire:model="nama_grup" id="nama_grup" placeholder="Nama Grup"
                        class="mt-1 block w-full px-3 py-2 border border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                </div>

                <!-- Tabel Daftar Kontak -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full bg-white shadow-md rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama Kontak</th>
                                <th class="px-4 py-2">No. Telepon</th>
                                <th class="px-4 py-2">Grup Kontak</th>
                                <th class="px-4 py-2">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontaks as $index => $kontak)
                                <tr class="border-t">
                                    <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $kontak->nama }}</td>
                                    <td class="px-4 py-2">{{ $kontak->no_hp }}</td>
                                    <td class="px-4 py-2">{{ $kontak->grups->count() }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <input type="checkbox" wire:model="selected_kontak" value="{{ $kontak->id }}"
                                            class="form-checkbox h-5 w-5 text-green-600">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5">
                        {{ $kontaks->links() }}
                    </div>
                </div>

                <!-- Tombol Simpan/Update -->
                <div class="mt-6 flex justify-between">
                    @if ($grup_id)
                        <button class="bg-green-600 text-white py-2 px-4 rounded"
                            wire:click="updategrup">UPDATE</button>
                    @else
                        <button class="bg-green-600 text-white py-2 px-4 rounded"
                            wire:click="tambahgrup">SIMPAN</button>
                    @endif
                    <button type="button" class="bg-red-600 text-white py-2 px-4 rounded"
                        wire:click="batal">Batal</button>
                </div>
            </div>
        </div>
    @endif





    @if ($isModalGrupOpen)
        <div x-data="{ isOpen: true }" x-show="isOpen" class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" x-show="open" @click="open = false">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline" x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                    Confirm Deletion
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Anda yakin menghapus Grup ini?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="delete" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                            Ya, Delete
                        </button>
                        <button wire:click="gajadi" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            gajadi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
