@extends('layouts.app') {{-- O el layout que estés usando --}}

@section('content')
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-6 mx-auto border border-red-600 mt-6">
        <h1 class="text-center font-semibold text-2xl mb-6">Listado de videos</h1>

        <input 
            type="text" 
            id="buscadorVideos" 
            placeholder="Buscar por nombre..." 
            class="w-full mb-6 px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400"
        >

        <div id="listaVideos">
            @forelse ($videos as $item)
                <div 
                    class="flex flex-col md:flex-row items-center mb-6 border-b pb-4 video-item"
                    data-nombre="{{ Str::lower($item->nombre) }}"
                >
                    <a href="{{$item->link}}">
                        <img 
                            src="https://img.youtube.com/vi/{{$item->codigo}}/hqdefault.jpg" 
                            alt="Miniatura de {{ $item->nombre }}" 
                            class="w-full md:w-48 rounded-lg shadow-md mb-4 md:mb-0 md:mr-6"
                        >
                    </a>
                    <div class="text-center md:text-left">
                        <h2 class="text-xl font-bold mb-2 nombre-video">{{ $item->nombre }}</h2>
                        <p class="text-gray-700">{{ $item->descripcion }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No hay videos disponibles.</p>
            @endforelse
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const input = document.getElementById('buscadorVideos');
                const videos = document.querySelectorAll('.video-item');

                input.addEventListener('input', function () {
                    const filtro = this.value.toLowerCase();

                    videos.forEach(video => {
                        const nombre = video.getAttribute('data-nombre');

                        if (filtro.length < 3) {
                            video.style.display = '';
                        } else {
                            if (nombre.includes(filtro)) {
                                video.style.display = '';
                            } else {
                                video.style.display = 'none';
                            }
                        }
                    });
                });
            });
        </script>
    @endpush


@endsection
