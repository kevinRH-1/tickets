<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Reporte') }}
        </h2>
    </x-slot>

    <style>
        .hidden {
            display: none;
        }
    </style>

<div class="container mx-auto p-6">

    <!-- Sección 1: Información del equipo y reporte -->
    <div class="bg-white p-6 rounded-lg shadow-lg space-y-4">
        <h2 class="text-xl font-semibold">Información del Equipo</h2>

        <label for="codigo" class="block font-medium">Código del equipo</label>
        <input type="text" name="codigo" id="codigo" value="{{ $reporte[0]->codigoequipo }}" class="border p-2 rounded bg-gray-100 w-full">

        @if($reporte[0]->pc ?? false)
            <div class="mt-4">
                <label for="pc-nombre" class="block font-medium">Nombre</label>
                <input type="text" name="codigo" id="pc-nombre" value="{{ $reporte[0]->pc->descripcion }}" class="border p-2 rounded bg-gray-100 w-full">

                <label for="pc-marca" class="block font-medium">Marca</label>
                <input type="text" name="codigo" id="pc-marca" value="{{ $reporte[0]->pc->marca }}" class="border p-2 rounded bg-gray-100 w-full">

                <label for="pc-estado" class="block font-medium">Estado</label>
                <input type="text" name="codigo" id="pc-estado" value="{{ $reporte[0]->pc->estado->descripcion }}" class="border p-2 rounded bg-gray-100 w-full">
            </div>
        @endif

        @if($reporte[0]->laptop ?? false)
            <div class="mt-4">
                <label for="laptop-nombre" class="block font-medium">Nombre</label>
                <input type="text" name="codigo" id="laptop-nombre" value="{{ $reporte[0]->laptop->descripcion }}" class="border p-2 rounded bg-gray-100 w-full">

                <label for="laptop-marca" class="block font-medium">Marca</label>
                <input type="text" name="codigo" id="laptop-marca" value="{{ $reporte[0]->laptop->marca }}" class="border p-2 rounded bg-gray-100 w-full">

                <label for="laptop-estado" class="block font-medium">Estado</label>
                <input type="text" name="codigo" id="laptop-estado" value="{{ $reporte[0]->laptop->estado->descripcion }}" class="border p-2 rounded bg-gray-100 w-full">
            </div>
        @endif

        @if($reporte[0]->impresora ?? false)
            <div class="mt-4">
                <label for="impresora-nombre" class="block font-medium">Nombre</label>
                <input type="text" name="codigo" id="impresora-nombre" value="{{ $reporte[0]->impresora->descripcion }}" class="border p-2 rounded bg-gray-100 w-full">

                <label for="impresora-marca" class="block font-medium">Marca</label>
                <input type="text" name="codigo" id="impresora-marca" value="{{ $reporte[0]->impresora->marca }}" class="border p-2 rounded bg-gray-100 w-full">

                <label for="impresora-estado" class="block font-medium">Estado</label>
                <input type="text" name="codigo" id="impresora-estado" value="{{ $reporte[0]->impresora->estado->descripcion }}" class="border p-2 rounded bg-gray-100 w-full">
            </div>
        @endif
    </div>

    <!-- Sección 2: Información del usuario -->
    <div class="bg-white p-6 mt-6 rounded-lg shadow-lg space-y-4">
        <h2 class="text-xl font-semibold">Información del Usuario</h2>

        <label for="sucursal" class="block font-medium">Sucursal</label>
        <input type="text" name="codigo" id="sucursal" value="{{ $reporte[0]->usuario->sucursal->nombre }}" class="border p-2 rounded bg-gray-100 w-full">

        <label for="usuario" class="block font-medium">Usuario</label>
        <input type="text" name="codigo" id="usuario" value="{{ $reporte[0]->usuario->name }}" class="border p-2 rounded bg-gray-100 w-full">

        <label for="correo" class="block font-medium">Correo</label>
        <input type="text" name="codigo" id="correo" value="{{ $reporte[0]->usuario->email }}" class="border p-2 rounded bg-gray-100 w-full">

        <label for="telefono" class="block font-medium">Teléfono</label>
        <input type="text" name="codigo" id="telefono" value="{{ $reporte[0]->usuario->phone }}" class="border p-2 rounded bg-gray-100 w-full">
    </div>

    <!-- Sección 3: Información del reporte y acción -->
    <div class="bg-white p-6 mt-6 rounded-lg shadow-lg space-y-4">
        <h2 class="text-xl font-semibold">Información del Reporte</h2>

        <label for="hora-generacion" class="block font-medium">Hora de Generación</label>
        <input type="text" name="codigo" id="hora-generacion" value="{{ $reporte[0]->created_at }}" class="border p-2 rounded bg-gray-100 w-full">

        <label for="riesgo" class="block font-medium">Riesgo</label>
        <input type="text" name="codigo" id="riesgo" value="bajo" class="border p-2 rounded bg-gray-100 w-full">

        <button id="toggle-mensajes" class="bg-blue-500 text-white p-2 rounded mt-4">Expandir</button>

        <div id="contenedor-mensajes" class="hidden mt-4">
            <div class="bg-black w-3/4 m-auto border p-4 space-y-4">
                @foreach($mensajes1 as $item)
                    @if($item->usuario->roleid == 1)
                        <div class="flex justify-end">
                            <input type="text" name="desc" id="desc" class="border p-2 rounded bg-gray-100" value="{{ $item->mensaje }}" readonly>
                        </div>
                    @else
                        <input type="text" name="desc" id="desc" class="border p-2 rounded bg-gray-100 w-full" value="{{ $item->mensaje }}" readonly>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sección 4: Formulario de envío -->
    <div class="bg-white p-6 mt-6 rounded-lg shadow-lg space-y-4">
        <h2 class="text-xl font-semibold">Enviar Respuesta</h2>

        <form action="{{ route('enviar.solucion', [$reporte[0]->id]) }}" method="POST">
            @csrf
            @if($reporte[0]->status_id != 3)
                @if(Auth::user()->roleid == 1)
                    <input type="text" name="problema1" id="problema1" readonly value="{{ $reporte[0]->descripcion }}" hidden>
                    <label for="mensaje" class="block font-medium">Mensaje</label>
                    <input type="text" name="mensaje" id="mensaje" oninput="toggleButton()" class="border p-2 rounded bg-gray-100 w-full">
                @else
                    <label for="mensaje" class="block font-medium">Mensaje</label>
                    <input type="text" name="mensaje" id="mensaje" class="border p-2 rounded bg-gray-100 w-full">
                @endif
            @endif

            <button class="btn btn-primary mt-4" type="submit">Enviar Mensaje</button>
        </form>
    </div>

</div>
</x-app-layout>

<script>
    $(document).ready(function(){
            const input = $('#solucion').val();
            const button = document.getElementById('boton');
            const link = document.getElementById('link');
            const reporte = $('#reporte').val();
            const usuario = $("#rol").val();
            var sucursal = $("#userid").val();

            if(sucursal == ""){
                sucursal = 0;
            }

            if (input == 1) {
                button.classList.remove('bg-gray-400', 'cursor-not-allowed');
                button.classList.add('bg-blue-500', 'hover:bg-blue-600', 'cursor-pointer');
                link.href = '/cambiar/estatus/' + reporte +  usuario + sucursal;
                console.log(reporte);
                console.log(link);
            } else {
                button.classList.add('bg-gray-400', 'cursor-not-allowed');
                button.classList.remove('bg-blue-500', 'hover:bg-blue-600', 'cursor-pointer');
                link.removeAttribute('href');
            }
    })   



    document.getElementById('toggle-mensajes').addEventListener('click', function () {
        const contenedor = document.getElementById('contenedor-mensajes');
        const boton = document.getElementById('toggle-mensajes');

        // Alternar clase 'hidden' para mostrar/ocultar
        if (contenedor.classList.contains('hidden')) {
            contenedor.classList.remove('hidden');
            boton.textContent = 'Contraer'; // Cambiar texto del botón
        } else {
            contenedor.classList.add('hidden');
            boton.textContent = 'Expandir'; // Cambiar texto del botón
        }
    });
</script>

{{-- {{route('cambiar.status', [$reporte[0]->id, Auth::user()->roleid])}} --}}
{{-- cambiar.status/' + reporte +  usuario --}}