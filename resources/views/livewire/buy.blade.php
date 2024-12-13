<div>
    <!-- Main Content Area -->
    <main class="flex-1 p-8">
        <div class="max-w-lg mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-green-600 p-6">
                <h2 class="text-center text-xl text-white font-semibold">PAKET {{ $payment->nama }}</h2>
            </div>
            <div class="p-6">
                <h3 class="text-2xl font-bold text-gray-700 mb-4">Terima kasih!!!</h3>
                <p class="text-gray-700 mb-2">Anda telah memilih paket BASIC senilai Rp. xx.xxx,xx</p>
                <p class="text-gray-700 mb-4">Jika Anda memiliki Kode Diskon, masukkan kode tersebut di bawah ini
                    lalu klik "Gunakan".</p>
                <div class="mb-4">
                    <input type="text" placeholder="Masukkan kode voucher" class="border rounded p-2 w-full" />
                    <button class="bg-black text-white p-2 rounded mt-2 ml-2">Add</button>
                </div>
                <p class="text-gray-700 mb-4">Klik "Lanjutkan" untuk mengonfirmasi pesanan Anda.</p>
                <div class="flex justify-between">
                    <a href="package.html">
                        <button class="bg-gray-300 text-gray-700 p-2 rounded">&lt;&lt; Back</button>
                    </a>
                    <a href="/customorder">
                        <button class="bg-green-600 text-white p-2 rounded">Lanjutkan &gt;&gt;</button>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
