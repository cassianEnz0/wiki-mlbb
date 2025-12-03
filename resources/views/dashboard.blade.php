<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-yellow-400 leading-tight uppercase tracking-wider">
                {{ __('Wiki Legend') }}
            </h2>

            <div class="flex gap-2 w-full md:w-auto justify-end items-center">
                <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2 w-full md:w-auto">
                    <input type="text" name="search" placeholder="Cari Hero..." value="{{ request('search') }}" 
                        class="border-gray-300 dark:border-yellow-600 dark:bg-[#0f172a] dark:text-white dark:placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full md:w-64">
                    <button type="submit" class="bg-gray-800 dark:bg-yellow-600 dark:text-black dark:font-bold text-white px-4 py-2 rounded-md hover:bg-gray-700 dark:hover:bg-yellow-500 transition">
                        Cari
                    </button>
                </form>
                
                @auth
                    <a href="{{ route('heroes.export.excel') }}" 
                        class="px-4 py-2 rounded-md whitespace-nowrap font-bold flex items-center bg-green-600 text-white hover:bg-green-700 shadow-md decoration-none text-sm">
                        Excel
                    </a>
                    <a href="{{ route('heroes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition whitespace-nowrap font-bold flex items-center decoration-none text-sm">
                        + Baru
                    </a>
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-[#060b19] min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative mb-6 shadow-sm" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-[#0f172a] overflow-hidden shadow-xl sm:rounded-lg mb-8 p-6 lg:p-8 border-t-4 border-blue-600 dark:border-yellow-500 transition-colors duration-300">
                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-yellow-400 mb-4 border-b dark:border-gray-700 pb-2">
                    Tentang Wiki Legend: Fanbase Mobile Legends: Bang Bang.
                </h3>
                <p class="text-gray-700 dark:text-gray-200 leading-relaxed mb-4">
                    Selamat datang di Wiki Legend, pusat informasi untuk para penggemar Mobile Legends: Bang Bang.
                    Wiki ini dibuat sebagai ruang komunitas yang menyajikan berbagai data, trivia, serta pembahasan lengkap mengenai hero, lore, item, role, dan update terbaru MLBB.
                    Tujuan utama Wiki Legend adalah membantu pemain, baik pemula maupun veteran, memahami gameplay, meta, dan perkembangan dunia MLBB. Semua konten disusun secara sederhana, terstruktur, dan mudah dijelajahi demi kenyamanan membaca.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($heroes as $hero)
                <div class="bg-white dark:bg-[#0f172a] overflow-hidden shadow-sm sm:rounded-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 relative group border border-gray-100 dark:border-yellow-600/40">
                    
                    @auth
                    <div class="absolute top-2 right-2 z-20 flex gap-2 opacity-0 group-hover:opacity-100 transition duration-300">
                        <a href="{{ route('heroes.edit', $hero->id) }}" class="bg-yellow-400 text-white p-2 rounded-full hover:bg-yellow-500 shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" /></svg>
                        </a>
                        <form id="delete-form-{{ $hero->id }}" action="{{ route('heroes.destroy', $hero->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmDelete('{{ $hero->id }}', '{{ $hero->name }}')" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 shadow-md transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                        </form>
                    </div>
                    @endauth

                    <a href="{{ route('heroes.show', $hero->id) }}" class="block relative h-64 w-full bg-gray-200 dark:bg-gray-800">
                        @if($hero->photo)
                            <img src="{{ asset('storage/' . $hero->photo) }}">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 dark:text-gray-500">No Photo</div>
                        @endif
                    </a>

                    <div class="px-3 pt-3 pb-6 text-center bg-white dark:bg-[#0f172a] relative z-10 border-t dark:border-gray-700">
                        <a href="{{ route('heroes.show', $hero->id) }}" class="hover:text-blue-600 dark:hover:text-yellow-200 transition">
                            <h3 class="text-md font-bold text-gray-800 dark:text-yellow-400 truncate">{{ $hero->name }}</h3>
                        </a>
                        <div class="mt-2 flex flex-wrap justify-center gap-1">
                            @foreach($hero->roles->take(2) as $role)
                                <span class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300 text-[10px] uppercase font-bold px-2 py-1 rounded border border-gray-200 dark:border-gray-600">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6 mb-12 dark:text-white">
                {{ $heroes->links() }}
            </div>
    </div>

    <footer class="w-full bg-[#050914] text-white border-t-4 border-yellow-500">
        <div class="max-w-7xl mx-auto px-6 py-10 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
             <div class="text-center md:text-left">
                <h2 class="text-3xl font-black uppercase tracking-widest text-white mb-2">
                    WIKI <span class="text-yellow-500">LEGEND</span>
                </h2>
            </div>
            <div class="text-center md:text-right">
                <p class="text-xl font-bold text-gray-100 tracking-wide">Sekolah Vokasi IPB University</p>
                <p class="text-gray-400 text-sm mt-2 font-light">Made by <span class="text-yellow-500 font-bold uppercase">Kelompok 1</span></p>
            </div>
        </div>
    </footer>

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
                    document.getElementById('delete-form-' + heroId).submit();
                }
            })
        }
    </script>
</x-app-layout>
