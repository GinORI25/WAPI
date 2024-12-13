<div>
    <section class="mt-2">
        <div class="grid">
            <div class="flex overflow-x-auto">
                <div class="flex p-8 rounded shadow space-x-3 w-full">
                    <div class="flex flex-col items-center justify-center p-6 bg-white rounded shadow">
                        <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                        <button class="bg-green-600 text-white py-2 px-4 rounded" wire:click="openModal">+ New
                            Project</button>
                    </div>
                    @foreach ($recentProject as $project)
                        <div class="flex flex-col items-center justify-center p-6 bg-white rounded shadow">
                            <a href="bc_list.html">
                                <div class="w-24 h-24 bg-gray-200 flex items-center justify-center mb-2">
                                    <img src="{{ asset('storage/' . $project->image) }}"
                                        alt="{{ $project->nama_project }}" class="w-full h-full object-cover">
                                </div>
                                <span style="font-size: 1.5rem; font-weight: bold;">{{ $project->nama_project }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </section>

    <!-- New Project Modal -->
    <div id="newproj"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50  {{ $showModal ? '' : 'hidden' }}">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h3 class="text-lg font-semibold mb-4 text-center">New Project</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Project</label>
                    <input type="text" id="nama_project" wire:model="nama_project"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Nama Kontak">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Handphone</label>
                    <input type="text" id="nomer_hp" wire:model="nomer_hp"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="08123456789">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" wire:model="username"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Username">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Account Facebook</label>
                    <input type="text" id="facebook" wire:model="facebook"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Account Facebook">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" wire:model="password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="********">
                </div>

                <div>

                    <div>
                        <button class="bg-black text-white py-2 px-4 rounded ml-2"
                            onclick="document.getElementById('image').click()">Pilih Photo</button>
                        <input type="file" id="image" wire:model="image" class="hidden">

                        <div
                            class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mb-2 overflow-hidden">
                            @if ($imageUrl)
                                <img src="{{ $imageUrl }}" class="object-cover w-full h-full"
                                    alt="Preview Gambar" />
                            @else
                                <span class="text-gray-400">100 x 100</span>
                            @endif
                        </div>

                    </div>


                </div>

            </div>
            <div class="mt-6 flex justify-between">
                <button class="bg-green-600 text-white py-2 px-4 rounded" wire:click="createProject">Buat
                    Project</button>
                <button class="bg-red-600 text-white py-2 px-4 rounded" wire:click="closeModal">Batal</button>
            </div>
        </div>
    </div>


    <!-- Recent Broadcast Section -->
    <section class="mt-8">
        <h2 class="text-xl font-bold mb-4">Recent Project</h2>
        <table class="min-w-full bg-white rounded shadow overflow-hidden">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No.</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Project</th>
                    <th class="py-2 px-4 border-b">Schedule</th>
                    <th class="py-2 px-4 border-b">Contact</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Credit</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($latestProject as $key => $value)
                    <tr>
                        <td class="py-2 px-4 border B">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b">{{ $value->username }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $value->nama_project }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $value->created_at->format('d M Y') }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $value->no_handphone }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $value->created_at->diffForHumans() }}</td>
                        <td class="py-2 px-4 border-b text-center">15000</td>
                        <td class="py-2 px-4 border-b flex justify-around">
                            <a href="stat.html">
                                <button class="text-green-600 hover:text-green-800">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                        <path
                                            d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                    </svg>
                                </button>
                            </a>
                            <button class="text-red-600 hover:text-red-800 mx-0">
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
        {{ $latestProject->links() }}
    </section>
</div>
</div>

<script>
    // JavaScript to add 'active' class to the current link
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('aside a');
        const currentPath = window.location.pathname.split('/').pop();
        links.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    });
</script>

</div>
