<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Hero MLBB') }}
            </h2>

            <div class="flex gap-2 w-full md:w-auto justify-end">
                <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2 w-full md:w-auto">
                    <input type="text" name="search" placeholder="Cari Hero..." value="{{ request('search') }}" 
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full md:w-64">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                        Cari
                    </button>
                </form>
                
                @auth
                    <a href="{{ route('heroes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition whitespace-nowrap font-bold flex items-center" style="text-decoration: none;">
                        + Baru
                    </a>
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 shadow-sm" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- START: Bagian About Web yang Baru -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8 p-6 lg:p-8 border-t-4 border-blue-600">
                <h3 class="text-2xl font-extrabold text-gray-900 mb-4 border-b pb-2">
                    Tentang Wiki Legend: Fanbase Mobile Legends: Bang Bang.
                </h3>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Selamat datang di Legend Wiki  rumah bagi para penggemar Mobile Legends: Bang Bang!
Website ini dibuat sebagai pusat informasi komunitas, tempat kamu bisa menemukan berbagai data, trivia, hingga pembahasan lengkap seputar hero, lore, item, role, dan update terbaru MLBB.

Kami hadir untuk memudahkan pemain baik pemula maupun veteran dalam memahami gameplay, meta, serta perkembangan dunia MLBB. Semua konten disusun secara sederhana, terstruktur, dan mudah dijelajahi agar pengalaman membaca kamu lebih nyaman.

WikiFans dikembangkan oleh komunitas fanbase yang ingin menghadirkan sumber informasi terpercaya dan selalu up to date. Setiap artikel yang ada di sini dibuat dengan semangat berbagi, belajar, dan merayakan dunia MLBB bersama-sama.

Terima kasih sudah mampir!
Selamat menjelajah, semoga web ini membantu perjalanan kamu menjadi pemain yang lebih hebat!
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Tujuan kami adalah menjadi sumber referensi cepat dan akurat, membantu Anda memilih hero yang tepat, memahami meta, dan menyusun strategi tim yang solid. Gunakan fitur pencarian di atas untuk menemukan hero favorit Anda atau jelajahi daftar hero di bawah ini!
                </p>
            </div>
            <!-- END: Bagian About Web yang Baru -->

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($heroes as $hero)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition duration-300 relative group border border-gray-100">
                    
                    <div class="relative h-64 w-full bg-gray-200">
                        @if($hero->photo)
                            <img src="{{ asset('storage/' . $hero->photo) }}" class="w-full h-full object-cover object-top" alt="{{ $hero->name }}">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">No Photo</div>
                        @endif
                        
                        <div class="absolute inset-0 bg-black bg-opacity-70 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col items-center justify-center gap-2">
                            
                            <a href="{{ route('heroes.show', $hero->id) }}" class="text-white border border-white px-4 py-1 rounded hover:bg-white hover:text-black text-sm w-24 text-center font-bold no-underline">Detail</a>
                            
                            @auth
                                <a href="{{ route('heroes.edit', $hero->id) }}" class="text-white border border-white px-4 py-1 rounded hover:bg-white hover:text-black text-sm w-24 text-center font-bold no-underline">Edit</a>
                                <form id="delete-form-{{ $hero->id }}" action="{{ route('heroes.destroy', $hero->id) }}" method="POST" style="display:inline;">
                                    @csrf 
                                    @method('DELETE')
    
                                    <button type="button" onclick="confirmDelete('{{ $hero->id }}', '{{ $hero->name }}')" class="text-white border border-white px-4 py-1 rounded hover:bg-white hover:text-black text-sm w-24 text-center font-bold no-underline">
                                        Hapus
                                    </button>
                                </form>
                            @endauth

                        </div>
                    </div>

                    <div class="px-3 pt-3 pb-6 text-center bg-white relative z-10 border-t">
                        <h3 class="text-md font-bold text-gray-800 truncate">{{ $hero->name }}</h3>
                        <div class="mt-2 flex flex-wrap justify-center gap-1">
                            @foreach($hero->roles->take(2) as $role)
                                <span class="bg-gray-100 text-gray-800 text-[10px] uppercase font-bold px-2 py-1 rounded border border-gray-200">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

            @if($heroes->isEmpty())
                <div class="text-center py-12 bg-white rounded-lg shadow-sm border border-dashed border-gray-300 mt-6">
                    <div class="flex flex-col items-center justify-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        @if(request('search'))
                            <p class="text-lg">
                                Hero dengan nama <strong>"{{ request('search') }}"</strong> tidak ditemukan.
                            </p>
                            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mt-2 text-sm">Reset Pencarian</a>
                        
                        @elseif(request('role'))
                            <p class="text-lg">
                                Belum ada Hero dengan Role <strong>{{ request('role') }}</strong>.
                            </p>
                            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mt-2 text-sm">Lihat Semua Hero</a>

                        @elseif(request('lane'))
                            <p class="text-lg">
                                Belum ada Hero untuk posisi <strong>{{ request('lane') }}</strong>.
                            </p>
                            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mt-2 text-sm">Lihat Semua Hero</a>

                        @else
                            <p class="text-lg mb-2">Belum ada data Hero di database.</p>
                            @auth
                                <p class="text-sm text-gray-400 mb-4">Jadilah yang pertama menambahkan hero!</p>
                                <a href="{{ route('heroes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition text-sm">
                                    + Tambah Hero Baru
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            @endif

            <div class="mt-6">
                {{ $heroes->links() }}
            </div>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(heroId, heroName) {
        Swal.fire({
            title: 'Hapus Hero ' + heroName + '?',
            text: "Data ini tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#fff',
            borderRadius: '10px'
        }).then((result) => {
            if (result.isConfirmed) {
                // Find the specific form for THIS hero and submit it
                document.getElementById('delete-form-' + heroId).submit();
            }
        })
    }
</script>
</x-app-layout>
