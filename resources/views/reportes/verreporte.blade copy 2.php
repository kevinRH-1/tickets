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

    <label for="codigo">codigo del equipo</label>
    <input type="text" name="codigo" id="codigo" value={{$reporte[0]->codigoequipo}}>
    <br>
    @if($reporte[0]->pc ?? false)
        <label for="">nombre</label>
        <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->pc->descripcion}}'>
        <br>
        <label for="">marca</label>
        <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->pc->marca}}'>
        <br>
        <label for="">estado</label>
        <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->pc->estado->descripcion}}'>
        
    @endif
    @if($reporte[0]->laptop ?? false)
        <label for="">nombre</label>
        <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->laptop->descripcion}}'>
        <br>
        <label for="">marca</label>
        <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->laptop->marca}}'>
        <br>
        <label for="">estado</label>
        <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->laptop->estado->descripcion}}'>
    @endif
    @if($reporte[0]->impresora ?? false)
        <label for="">nombre</label>
        <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->impresora->descripcion}}'>
        <br>
        <label for="">marca</label>
        <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->impresora->marca}}'>
        <br>
        <label for="">estado</label>
        <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->impresora->estado->descripcion}}'>
    @endif

    <br>
    <br>
    <br>

    <label for="">sucursal</label>
    <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->usuario->sucursal->nombre}}'>
    <br>
    <label for="">usuario</label>
    <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->usuario->name}}'>
    <br>
    <label for="">correo</label>
    <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->usuario->email}}'>
    <br>
    <label for="">telefono</label>
    <input type="text" name="codigo" id="codigo" value='{{$reporte[0]->usuario->phone}}'>


    <br>
    <br>
    <br>

    <label for="">hora de generacion</label>
    <input type="text" name="codigo" id="codigo" value={{$reporte[0]->created_at}}>
    <br>
    <label for="">riesgo</label>
    <input type="text" name="codigo" id="codigo" value='bajo'>
    <br>

    <br>
    <br>
    <br>
    

    <input type="text" hidden value="{{$rol[0]}}">

    <button id="toggle-mensajes" class="bg-blue-500 text-white p-2 rounded">Expandir</button>

    <div id="contenedor-mensajes" class="hidden">
        <div class="bg-black w-3/4 m-auto mt-20 border p-4 space-y-4">
            @foreach($mensajes1 as $item)
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


    <form action="{{route ('enviar.solucion', [$reporte[0]->id])}}" method="POST">

        @csrf


        @if($reporte[0]->status_id != 3)
            @if(Auth::user()->roleid==1)
                
                {{-- <label for="">descripcion del problema</label> --}}
                <input type="text" name="problema1" id="problema1" readonly value="{{$reporte[0]->descripcion}}" hidden>
                <br>
                <label for="">mensaje</label>
                <input type="text" name="mensaje" id="mensaje" oninput="toggleButton()">

                

            @else

                {{-- @if($reporte[0]->status_id==3) --}}

                <label for="">mensaje</label>
                <input type="text" name="mensaje" id="mensaje" >
                
                {{-- <label for="">solucion del tecnico</label>
                <input type="text" name="solucion2" id="solucion2" readonly value="{{$reporte[0]->solucion}}"> --}}
                {{-- @else --}}

                {{-- @endif --}}
            @endif
        @else
            {{-- <label for="">descripcion del problema</label>
            <input type="text" name="problema1" id="problema1" readonly value="{{$reporte[0]->descripcion}}">
            <br>
            <label for="">solucion del tecnico</label>
            <input type="text" name="mensaje" id="mensaje" readonly value="{{$reporte[0]->solucion}}"> --}}
        @endif
    
        <input type="text" name="userid" id="userid" hidden value="{{Auth::user()->lugar_id}}">

        <input type="text" name="reporte" id="reporte" hidden value="{{$reporte[0]->id}}">
        <input type="text" name="usuario" id="usuario" hidden value="{{Auth::user()->id}}">
        <input type="text" name="rol" id="rol" hidden value="{{Auth::user()->roleid}}">
    
        @if($reporte[0]->status_id!=3)
            @if(Auth::user()->roleid ==1)
                <button class="btn btn-primary" type="submit">enviar mensaje</button>
                <input type="text" name="tecnico" id="tecnico" value="{{Auth::user()->id}}" hidden>
            @else
                <button class="btn btn-primary" type="submit">enviar respuesta</button>
            @endif
        @endif


    </form>

    <label for="estado">Estado</label>
    <input type="text" name="verestado" id="verestado" readonly value="{{$reporte[0]->status->nombre}}">


    <input type="text" name="solucion" id="solucion" value="{{$confirmar}}" hidden>




    <a href="{{route('historial.mensajes', [$reporte[0]->id])}}"><button>historial de mensajes</button></a>
    <br>
    @if($reporte[0]->status_id==3)
        <label for="">Solucionado</label>
    @else
        @if(Auth::user()->roleid==1 )
            <a href="#" id="link" name="link" ><button name="boton" id="boton" class="px-6 py-2 bg-gray-400 text-white font-semibold rounded-md cursor-not-allowed">enviar solicitud para confirmar solucion</button></a>
        @endif
        @if(Auth::user()->roleid == 2 && $reporte[0]->solucionado_tecnico ==1)
            <a href="{{route('cambiar.status', [$reporte[0]->id, Auth::user()->roleid, Auth::user()->lugar_id])}}"><button class="btn btn-primary">confirmar solucion</button></a>
        @endif
    @endif
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