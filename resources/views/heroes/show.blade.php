<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $hero->name }}
            </h2>
            
            <div class="flex items-center gap-2">
                
                @auth
                    <a href="{{ route('heroes.edit', $hero->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-1 px-3 rounded text-sm transition" style="text-decoration: none;">
                        ✏️ Edit
                    </a>

                    <form action="{{ route('heroes.destroy', $hero->id) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus artikel {{ $hero->name }}? Data tidak bisa kembali!');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm transition">
                            🗑️ Hapus
                        </button>
                    </form>
                @else
                    <span class="text-xs text-gray-400 mr-2 italic">Login untuk mengedit</span>
                @endauth

                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm ml-2" style="text-decoration: none;">
                    &larr; Kembali
                </a>
            </div>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="md:flex gap-8">
                        <div class="md:w-1/3 mb-6 md:mb-0">
                            <div class="sticky top-4">
                                <img src="{{ asset('storage/' . $hero->photo) }}" 
                                     class="w-56 h-80 mx-auto rounded-lg shadow-md mb-4 object-cover object-top" 
                                     alt="{{ $hero->name }}">
                                
                                <div class="space-y-4">
                                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Roles</h3>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($hero->roles as $role)
                                                <div class="flex items-center bg-white border border-gray-200 rounded-md px-2 py-1 shadow-sm">
                                                    @if($role->image)
                                                        <img src="{{ asset($role->image) }}" class="w-5 h-5 mr-2" alt="icon">
                                                    @endif
                                                    <span class="text-sm font-semibold text-gray-700">{{ $role->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Laning / Position</h3>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($hero->positions as $pos)
                                                <div class="flex items-center bg-white border border-gray-200 rounded-md px-2 py-1 shadow-sm">
                                                    @if($pos->image)
                                                        <img src="{{ asset($pos->image) }}" class="w-5 h-5 mr-2" alt="icon">
                                                    @endif
                                                    <span class="text-sm font-semibold text-gray-700">{{ $pos->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="md:w-2/3">
                            
                            <div class="mb-8">
                                <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                                    <span class="w-1 h-6 bg-blue-500 rounded-full mr-3"></span>
                                    Recommended Build
                                </h3>
                                <div class="grid grid-cols-6 gap-3">
                                    @foreach($hero->items as $item)
                                        <div class="group relative">
                                            <div class="aspect-square bg-gray-800 rounded-lg overflow-hidden border border-gray-200 hover:border-yellow-400 transition shadow-sm">
                                                @if($item->image)
                                                    <img src="{{ asset($item->image) }}" class="w-full h-full object-contain p-1" alt="{{ $item->name }}">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-white text-xs">No IMG</div>
                                                @endif
                                            </div>
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap z-10 shadow-lg">
                                                {{ $item->name }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <hr class="my-6 border-gray-100">

                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                                    <span class="w-1 h-6 bg-purple-500 rounded-full mr-3"></span>
                                    Story / Lore
                                </h3>
                                <div class="prose max-w-none text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    {!! $hero->story !!}
                                </div>
                            </div>

                            <div class="mt-8 pt-4 border-t border-gray-100 text-xs text-gray-400 flex justify-between">
                                <span>Last Editor: {{ $hero->author->name ?? 'Unknown' }}</span>
                                <span>Updated: {{ $hero->updated_at->diffForHumans() }}</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>