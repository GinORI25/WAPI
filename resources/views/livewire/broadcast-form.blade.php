    <div>
        <div class="flex" x-data="{
            message: @entangle('message').defer,
            error: '',
            showButton: @entangle('showButton').defer,
            buttonText: @entangle('buttonText').defer,
            buttonUrl: @entangle('buttonUrl').defer,
        
            getPreviewMessage() {
                return this.message ? this.message.replace(/\{\{\s*nama\s*\}\}/g, 'John') : '';
            },
        
            insertTag(tag) {
                let textarea = this.$refs.messageTextarea;
                let cursorPosStart = textarea.selectionStart;
                let cursorPosEnd = textarea.selectionEnd;
                let textBefore = textarea.value.substring(0, cursorPosStart);
                let selectedText = textarea.value.substring(cursorPosStart, cursorPosEnd);
                let textAfter = textarea.value.substring(cursorPosEnd);
        
                if (Array.isArray(tag)) {
                    this.message = textBefore + tag[0] + selectedText + tag[1] + textAfter;
                    this.$nextTick(() => {
                        textarea.setSelectionRange(cursorPosStart + tag[0].length, cursorPosEnd + tag[0].length);
                    });
                } else {
                    this.message = textBefore + tag + textAfter;
                    this.$nextTick(() => {
                        textarea.setSelectionRange(cursorPosStart + tag.length, cursorPosEnd + tag.length);
                    });
                }
        
                textarea.focus();
                textarea.value = this.message;
            },
            convertToBoolean(value) {
                return value === 'true';
            }
        }" x-init="$watch('getPreviewMessage()', value => message = value)"
            @insert-tag.window="insertTag($event.detail.tag)">

            <div class="w-1/2 p-4">
                <form wire:submit.prevent="{{ $broadcastId ? 'update' : 'tambahBroadcast' }}">
                    <!-- Input Nama Broadcast -->
                    <div class="mb-4">
                        <label for="bcname" class="block text-gray-700 font-bold mb-2">Nama Broadcast</label>
                        <input type="text" id="bcname" name="bcname" wire:model="bcname"
                            placeholder="Nama broadcast"
                            class="border border-gray-300 shadow-md rounded py-2 px-3 w-1/3 text-gray-700 leading-tight focus:shadow-outline">
                    </div>

                    {{-- kontak multiple select  --}}
                    <label for="schedule" class="block text-gray-700 font-bold mb-2"> tambahkan Kontak</label>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2"
                        wire:click="pilihkontak">Kontak</button>

                    <!-- Preview kontak yang dipilih -->
                    @if (!empty($selectedKontak))
                        <div class="mt-4 px-4 py-2 bg-white rounded-lg shadow-lg">
                            <h4 class="text-lg font-semibold mb-5">Kontak yang Dipilih:</h4>
                            <ul class="list-decimal ml-5">
                                @foreach ($selectedKontak as $id)
                                    @php
                                        $kontak = \App\Models\ListKontak::find($id);
                                    @endphp
                                    <li>{{ $kontak->nama }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @if ($isKontakVisible)
                        <div id="tamKon"
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-3/4">
                                <h3 id="judul" name="judul"
                                    class="text-lg font-semibold mb-4 text-center text-green-600">
                                    Tambah Kontak
                                </h3>

                                <!-- Cari nama Kontak -->
                                <div class="mb-6">
                                    <label for="nama_grup"
                                        class="form-control block text-sm font-medium text-gray-700">Nama
                                        Kontak</label>
                                    <input type="text" id="katakunci" wire:model.live="katakunci"
                                        placeholder="Cari Kontak"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
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
                                                    <td class="px-4 py-2">
                                                        @foreach ($kontak->grups as $grup)
                                                            {{ $grup->nama_grup }}@if (!$loop->last)
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td class="px-4 py-2 text-center">
                                                        <input type="checkbox" wire:model="selectedKontak"
                                                            value="{{ $kontak->id }}"
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

                                <!-- Tombol Simpan Kontak -->
                                <div class="mt-6 flex justify-between">
                                    <button type="submit" wire:click="simpanKontak"
                                        class="bg-green-600 text-white py-2 px-4 rounded">
                                        SIMPAN
                                    </button>
                                    <button type="button" class="bg-red-600 text-white py-2 px-4 rounded"
                                        wire:click="batal">Batal</button>
                                </div>


                            </div>
                        </div>
                    @endif


                    {{-- tanggal waktu dan jam  --}}
                    <div class="mb-4 mt-5">
                        <div class="flex space-x-2">
                            <label for="scheduleDate" class="block text-gray-700 font-bold mb-2">Tanggal</label>
                            <input type="date" id="scheduleDate" wire:model="scheduleDate"
                                class="border border-gray-300 shadow-md rounded py-2 px-3 w-1/3">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="scheduleTime" class="block text-gray-700 font-bold mb-2">Jam</label>
                        <input type="number" id="scheduleTime" wire:model="scheduleTime" min="0" max="23"
                            placeholder="00" class="border border-gray-300 shadow-md rounded py-2 px-3 w-16">
                    </div>

                    {{-- input pesan --}}
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Pesan:</label>
                        <button type="button" @click.prevent="$dispatch('insert-tag', { tag: '\{\{ nama \}\}' })"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">John</button>
                        <button type="button" @click.prevent="$dispatch('insert-tag', { tag: ['<b>', '</b>'] })"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Bold</button>
                        <textarea id="message" name="message" x-ref="messageTextarea" x-model="message" wire:model="message" rows="6"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>

                    </div>


                    {{-- upload gambar  --}}
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
                        <input type="file" id="image" name="image" wire:model="image"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <div x-show="error" class="text-red-500 mt-2" x-text="error"></div>

                    </div>

                    {{-- interaksi --}}
                    <div class="mb-4">
                        <label for="showButton" class="block text-gray-700 text-sm font-bold mb-2">Tombol
                            Interaksi:</label>
                        <div class="flex items-center space-x-4">

                            <div class="flex items-center">
                                <input type="radio" id="ada" name="showButton" value="true"
                                    wire:model="showButton" x-model="showButton" class="mr-2 leading-tight">
                                <label for="ada" class="text-gray-700">Ada</label>
                            </div>

                            <div class="flex items-center">
                                <input type="radio" id="tidak" name="showButton" value="false"
                                    wire:model="showButton" x-model="showButton" class="mr-2 leading-tight">
                                <label for="tidak" class="text-gray-700">Tidak</label>
                            </div>

                        </div>
                    </div>

                    {{-- opsyonal --}}
                    <div x-show="convertToBoolean(showButton)" class="mb-4">
                        <label for="buttonUrl" class="block text-gray-700 font-bold mb-2">Alamat URL:</label>
                        <input type="text" id="buttonUrl" wire:model="buttonUrl"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan Alamat URL" x-model="buttonUrl">
                    </div>

                    <div x-show="convertToBoolean(showButton)" class="mb-4">
                        <label for="buttonText" class="block text-gray-700 font-bold mb-2">Teks Tombol:</label>
                        <input type="text" id="buttonText" wire:model="buttonText"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    {{-- submit --}}
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2"
                            wire:click="tambahBroadcast">
                            simpan
                        </button>
                    </div>

                </form>
            </div>

            <div class="w-1/2 p-4">
                <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg overflow-hidden mb-4">
                    <div class="p-4">
                        <div class="bg-cover h-96"
                            style="background-image: url('{{ $image ? $image->temporaryUrl() : asset('assets/default.jpg') }}')">
                        </div x-data="{ message: '' }">
                        <h1 class="text-gray-900 font-bold text-2xl break-words whitespace-normal"
                            x-html="getPreviewMessage()"></h1>

                        <p class="mt-2 text-gray-600">Your Preview</p>
                    </div>
                </div>
                <div x-show="convertToBoolean(showButton)" class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-4">
                    <a :href="buttonUrl" target="_blank"
                        class=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full text-center block"
                        x-text="buttonText || 'CEK SEKARANG'"></a>
                </div>
            </div>

        </div>
    </div>
