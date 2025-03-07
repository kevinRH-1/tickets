<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis mensajes') }}
        </h2>

    </x-slot>

    <div>
        <div class="bg-black w-3/4 m-auto mt-20 border p-4 space-y-4">
            @foreach($mensajes as $item)
                @if($item->usuario->roleid == 1)
                    <!-- Input para roleid 1 (alineado a la derecha) -->
                    <div class="flex justify-end">
                        <input type="text" name="desc" id="desc" class="border p-2 rounded bg-gray-100" value="{{$item->mensaje}}" readonly>
                    </div>
                @else 
                    <!-- Input para otros roles (alineado a la izquierda) -->
                    <input type="text" name="desc" id="desc" class="border p-2 rounded bg-gray-100 w-full" value="{{ $item->mensaje }}" readonly>
                @endif
            @endforeach
        </div>
    </div>



</x-app-layout>