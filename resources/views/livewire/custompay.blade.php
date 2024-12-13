<div>
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col flex-1 p-6">
            <div class="flex flex-col md:flex-row justify-between gap-4 mt-6">
                <div class="w-full md:w-1/2 bg-white pt-11 p-7 rounded-lg shadow-lg">
                    <h1 class="text-2xl font-bold">
                        Bayar Disini
                    </h1>

                    <div class="max-w-md mx-auto bg-white p-6 rounded-lg mt-6">
                        <form action="#" wire:submit.prevent="save" class="space-y-4">
                            <!-- ID User Field -->
                            <div>
                                <label for="id_user" class="block text-sm font-medium text-gray-700">ID User :</label>
                                <input type="text" id="iduser"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                                    placeholder="Masukkan ID" wire:model="iduser">
                            </div>

                            <!-- Nama Field -->
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700"> Nama Paket
                                    :</label>
                                <input type="text" id="nama"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                                    placeholder="Masukkan Nama Paket" wire:model="nama">
                            </div>

                            <!-- Username Field -->
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username :</label>
                                <input type="text" id="username" name="username"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                                    placeholder="Masukkan Username" wire:model="username">
                            </div>

                            <!-- Harga Bayar Field -->
                            <div x-data="rupiahInputHandler()" x-init="$watch('inputValue', value => formattedValue = formatToRupiah(value))">
                                <label for="harga_bayar" class="block text-sm font-medium text-gray-700 mb-2">Harga
                                    Bayar
                                    :</label>
                                <!-- Menampilkan nominal yang dimasukkan -->
                                <div class="text-center font-bold mt-3">
                                    <span x-text="formattedValue"></span>
                                </div>

                                <input type="text" id="harga_bayar" wire:model="harga_bayar" x-model="inputValue"
                                    @input="validateInput" class="border p-2 rounded" placeholder="Masukkan nominal">

                                <script>
                                    function rupiahInputHandler() {
                                        return {
                                            inputValue: '',
                                            formattedValue: '',

                                            validateInput() {
                                                this.inputValue = this.inputValue.replace(/[^0-9]/g, ''); // Hapus karakter non-angka
                                            },

                                            formatToRupiah(value) {
                                                if (!value) return 'Rp 0'; // Jika kosong, tampilkan Rp 0
                                                return 'Rp ' + parseInt(value, 10).toLocaleString('id-ID');
                                            }
                                        };
                                    }
                                </script>
                            </div>

                            <!-- Metode Bayar Field -->
                            <div>
                                <label for="metode_bayar" class="block text-sm font-medium text-gray-700">Metode Bayar
                                    :</label>
                                <select wire:model="metode_bayar"
                                    class="mt-1 block w-full border-gray-300 rounded-md p-3 shadow-sm focus:border-green-500 focus:ring-green-500">
                                    <option value="BRI">BRI</option>
                                    <option value="BNI">BNI</option>
                                    <option value="BTN">BTN</option>
                                    <option value="Dana">Dana</option>
                                    <option value="Gopay">Gopay</option>
                                    <option value="OVO">OVO</option>
                                    <option value="Shopee Pay">Shopee Pay</option>
                                </select>
                            </div>

                            <!-- Catatan Field -->
                            <div>
                                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan:</label>
                                <textarea wire:model="catatan" id="catatan" name="catatan" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                                    placeholder="Masukkan Catatan"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" wire:click="save"
                                    class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    @if ($paymentId)
                                        Update
                                    @else
                                        Bayar
                                    @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="w-full md:w-2/3 bg-white pt-11 p-7 rounded-lg shadow-lg">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-green-900 text-white">
                                <th class="border-b-2 p-4">User Id</th>
                                <th class="border-b-2 p-4">Username</th>
                                <th class="border-b-2 p-4">Transaction</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPayment as $payment)
                                <tr>
                                    <td class="border-b p-3 text-center">{{ $payment->iduser }}</td>
                                    <td class="border-b p-3 text-center">{{ $payment->username }}</td>
                                    <td class="border-b p-3 text-center">{{ $payment->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $dataPayment->links() }}
                </div>
            </div>

        </div>
    </div>

</div>
