<div>

    <div class="w-full mx-auto bg-white p-5 rounded-lg shadow-lg mt-6">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-2xl font-bold">Broadcast List</h2>

            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12.9 14.32a8 8 0 111.414-1.414l5.387 5.387-1.414 1.414-5.387-5.387zM8 14a6 6 0 100-12 6 6 0 000 12z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
                <input type="text" placeholder="Search"
                    class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <a href="{{ url('/broadcast') }}">
                <button class="bg-black text-white px-4 py-2 rounded-lg ml-4">
                    Tambah Broadcast
                </button>
            </a>

            <div class="relative inline-block text-left ml-4">
                <button type="button"
                    class="inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    id="menu-button" aria-expanded="true" aria-haspopup="true">
                    Sort by: ID
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 01.976.073l.084.073L10 11.939l3.707-3.707a.75.75 0 111.133.976l-.073.084-4.5 4.5a.75.75 0 01-.976.073l-.084-.073-4.5-4.5a.75.75 0 010-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border-b-2 p-2">No</th>
                    <th class="border-b-2 p-2">Nama Broadcast</th>
                    <th class="border-b-2 p-2">Dibuat</th>
                    <th class="border-b-2 p-2">Dijadwal</th>
                    <th class="border-b-2 p-2">Status</th>
                    <th class="border-b-2 p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataBroadcast as $index => $broadcast)
                    <tr class="bg-gray-100">
                        <td class="border-b p-2 text-center">{{ $index + 1 }}</td>
                        <td class="border-b p-2 text-center">{{ $broadcast->bcname }}</td>
                        <td class="border-b p-2 text-center">{{ $broadcast->created_at }}</td>
                        <td class="border-b p-2 text-center">{{ $broadcast->waktu }}</td>
                        <td class="border-b p-2 text-center">Draft </td>
                        <td class="py-2 px-4 border-b flex justify-around">
                            <button class="text-green-600 hover:text-green-800"
                                wire:click="editBroadcast({{ $broadcast->id }})">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                    <path
                                        d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                </svg>
                            </button>
                            <button class="text-red-600 hover:text-red-800"
                                wire:click="deleteConfirm({{ $broadcast->id }})">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"
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

        {{ $dataBroadcast->links() }}


        <div class="flex justify-center mt-5">
            <nav>

            </nav>
        </div>
    </div>

    {{-- delete confirm  --}}

    @if ($isVisible)
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
                                        Anda yakin menghapus kontak ini?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="delete()" type="button"
                            class="inline-flex justify- center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                            Ya, Delete
                        </button>
                        <button wire:click="batal" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            gajadi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif



</div>
