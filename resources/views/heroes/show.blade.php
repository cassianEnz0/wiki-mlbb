<x-app-layout>
    
    <div class="py-12 bg-gray-100 dark:bg-[#060b19] min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-[#0f172a] overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-transparent dark:border-yellow-500 transition-colors duration-300">
                <div class="p-6 bg-white dark:bg-[#0f172a] border-b border-gray-200 dark:border-gray-800">
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-2 border-gray-100 dark:border-gray-700 pb-6 mb-8 gap-4">
                        
                        <div>
                        
                            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight leading-tight">
                                {{ $hero->name }}
                            </h1>
                            <div class="flex flex-wrap gap-2 mt-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100 px-2 py-0.5 rounded text-xs font-bold">WIKI PAGE</span>
                                <span>&bull;</span>
                                <span>Updated: {{ $hero->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div>
                            @auth
                                <div class="flex items-center justify-end mb-4">
                                    <a href="{{ route('heroes.edit', $hero->id) }}" 
                                    class="text-sm font-bold text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-200 uppercase flex items-center gap-1 transition decoration-transparent mr-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit This Page
                                    </a>

                                    <a href="{{ route('dashboard') }}" 
                                    class="text-sm font-bold text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-200 uppercase flex items-center gap-1 transition decoration-transparent">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                        Kembali
                                    </a>
                                </div>

                            @else
                                <a href="{{ route('login') }}" 
                                   class="text-xs font-bold text-yellow-900 hover:text-black uppercase flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 px-5 py-2 rounded-full transition shadow-sm decoration-transparent">
                                    Sign in to Edit
                                </a>
                            @endauth
                        </div>
                    </div>
                    
                    <div class="md:flex gap-10">
                        <div class="md:w-1/3 mb-6 md:mb-0">
                            <div class="sticky top-4">
                                <div class="bg-gradient-to-b from-yellow-300 via-yellow-400 to-yellow-600 p-1.5 rounded-lg shadow-xl w-56 mx-auto">
                                    <img src="{{ asset('storage/' . $hero->photo) }}" 
                                        class="w-full h-80 object-cover object-top rounded border-2 border-yellow-200" 
                                        alt="{{ $hero->name }}">
                                    <div class="bg-yellow-700 text-white text-center py-1.5 font-bold uppercase tracking-widest text-xs rounded-b shadow-inner border-t border-yellow-600">
                                        {{ $hero->name }}
                                    </div>
                                </div>
                                
                                <div class="space-y-4 mt-8">
                                    <div class="bg-gray-50 dark:bg-gray-800 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <h3 class="text-xs font-bold text-gray-400 dark:text-gray-400 uppercase tracking-wide mb-2">Roles</h3>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($hero->roles as $role)
                                                <div class="flex items-center bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-md px-2 py-1 shadow-sm">
                                                    @if($role->image) <img src="{{ asset($role->image) }}" class="w-5 h-5 mr-2" alt="icon"> @endif
                                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $role->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 dark:bg-gray-800 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <h3 class="text-xs font-bold text-gray-400 dark:text-gray-400 uppercase tracking-wide mb-2">Laning / Position</h3>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($hero->positions as $pos)
                                                <div class="flex items-center bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-md px-2 py-1 shadow-sm">
                                                    @if($pos->image) <img src="{{ asset($pos->image) }}" class="w-5 h-5 mr-2" alt="icon"> @endif
                                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $pos->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @auth
                                    <div class="text-center pt-4">
                                        <form id="delete-form" action="{{ route('heroes.destroy', $hero->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete()" 
                                                class="text-yellow-600 dark:text-yellow-500 font-bold text-xs uppercase tracking-wider hover:text-red-600 transition decoration-transparent flex items-center justify-center gap-1 mx-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                                Delete this Page
                                            </button>
                                        </form>
                                    </div>
                                    @endauth
                                </div>
                            </div>
                        </div>

                        <div class="md:w-2/3">
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-3 flex items-center">
                                    <span class="w-1 h-6 bg-blue-500 rounded-full mr-3"></span>
                                    Recommended Build
                                </h3>
                                <div class="flex flex-wrap gap-3">
                                    @foreach($hero->items as $item)
                                        <div class="group relative bg-gray-800 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-600 hover:border-yellow-400 transition shadow-sm" style="width: 56px; height: 56px;"> 
                                            @if($item->image) <img src="{{ asset($item->image) }}" class="w-full h-full object-contain p-1" alt="{{ $item->name }}"> @endif
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap z-10 shadow-lg">{{ $item->name }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <hr class="my-6 border-gray-100 dark:border-gray-700">

                            <div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-3 flex items-center">
                                    <span class="w-1 h-6 bg-purple-500 rounded-full mr-3"></span>
                                    Story / Lore
                                </h3>
                                <div class="prose max-w-none text-gray-700 dark:text-gray-300 leading-relaxed bg-gray-50 dark:bg-gray-800 p-4 rounded-lg border border-gray-100 dark:border-gray-700">
                                    {!! $hero->story !!}
                                </div>
                            </div>

                            <div class="mt-8 pt-4 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-400 flex justify-between">
                                <span>Last Editor: {{ $hero->author->name ?? 'Unknown' }}</span>
                                <span>Updated: {{ $hero->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Yakin mau hapus?', text: "Data ini hilang selamanya!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, Hapus!'
            }).then((result) => { if (result.isConfirmed) document.getElementById('delete-form').submit(); })
        }
    </script>
</x-app-layout>
