@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">{{ __('oops! Algo salio mal.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li><span>Estas credenciales no coinciden con nuestros registros</span></li>
            @endforeach
        </ul>
    </div>
@endif
