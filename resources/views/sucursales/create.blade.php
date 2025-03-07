@extends('layouts.app')

@section('content')

    <div>
        <form action="{{route ('sucursal.store')}}" method="POST" id="formsucursal">
            @csrf
            <label for="nombre"></label>
            <input type="text" name="nombre" id="nombre">

            <br>
            <button type="submit">Registrar</button>
        </form>
    </div>

@endsection