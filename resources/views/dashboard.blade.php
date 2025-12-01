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
                                <form action="{{ route('heroes.destroy', $hero->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-white border border-white px-4 py-1 rounded hover:bg-white hover:text-black text-sm w-24 text-center font-bold no-underline">Hapus</button>
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
                    <p class="text-gray-500 text-lg">
                        Hero <strong>"{{ request('search') }}"</strong> tidak ditemukan.
                    </p>
                    @if(request('search'))
                        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mt-2 inline-block">Reset Pencarian</a>
                    @endif
                </div>
            @endif

            <div class="mt-6">
                {{ $heroes->links() }}
            </div>

        </div>
    </div>
</x-app-layout>