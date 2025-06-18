@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="w-full max-w-4xl mx-auto mt-8 bg-white p-10 rounded-lg shadow-md">
    
    <!-- Espacio para imagen -->
    <div class="flex justify-center mb-8">
      <div class="w-28 h-28 bg-gray-200 rounded-lg">
        <img src="../resources/imagen/DobermaN.png" alt="Logo" class=" hidden lg:block  ">
      </div>
    </div>

    <!-- Formulario en dos columnas -->
    <form action="#" method="POST">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
          <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
          <input type="text" id="nombre" name="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            <p id="nombre-error" class="text-red-500 text-sm " hidden>el nombre no puede estar vacio!</p>
        </div>

        <div>
          <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
          <input type="text" id="apellido" name="apellido" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
          <p id="apellido-error" class="text-red-500 text-sm " hidden>el apellido no puede estar vacio!</p>
        </div>

        <div>
          <label for="telefono" class="block text-sm font-medium text-gray-700">Número telefónico</label>
          <input type="text" id="telefono" name="telefono" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
          <p id="numero-error" class="text-red-500 text-sm " hidden>el numero no puede estar vacio!</p>
          <p id="numero-error2" class="text-red-500 text-sm " hidden>el formato es incorrecto!</p>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
          <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
          <p id="correo-error" class="text-red-500 text-sm " hidden>el correo no puede estar vacio!</p>
          <p id="correo-error2" class="text-red-500 text-sm " hidden>el formato es incorrecto!</p>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
          <input type="password" id="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
          <p id="password-error" class="text-red-500 text-sm " hidden>la contraseña no puede estar vacia!</p>
          <p id="password-error2" class="text-red-500 text-sm " hidden>la contraseña no puede ser menor a 4 digitos!</p>
        </div>

        <div>
          <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
          <input type="password" id="confirm-password" name="confirm-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
          <p id="confpassword-error" class="text-red-500 text-sm " hidden>la contraseña no coincide!</p>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Sucursal</label>
            <select name="sucursal" id="sucursal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($sucursales as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
        </div>

      </div>

      <div class="mt-8 text-center">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition" onclick="registrar(event)">Registrarse</button>
      </div>
    </form>
  </div>

  <script src="../resources/jquery/jquery-3.6.0.min.js"></script>

  <script>

    function validarFormulario(formData) {

        valido = true;
        // Verificar campos vacíos
        for (const campo in formData) {
            if (!formData[campo]) {
                $(`#${campo}-error`).removeAttr('hidden');
                valido = false;
            }else{
                $(`#${campo}-error`).attr('hidden', true);
            }
        }

        // Validar número telefónico (solo dígitos)
        const telefonoRegex = /^[0-9]+$/;
            if (!telefonoRegex.test(formData.numero)) {
                $(`#numero-error2`).removeAttr('hidden');
                valido = false;
            }else{
                $(`#numero-error2`).attr('hidden', true);
            }

        // Validar correo electrónico
        const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!correoRegex.test(formData.correo)) {
                $(`#correo2-error`).removeAttr('hidden');
                valido = false;
            }else{
                $(`#correo2-error`).attr('hidden', true);
            }

        if(formData.confpassword != formData.password){
            $(`#confpassword-error`).removeAttr('hidden');
                valido = false;
        }else{
            $(`#confpassword-error`).attr('hidden', true);
        }

        if(formData.password.length < 4){
            $(`#password-error2`).removeAttr('hidden');
            valido = false;
        }else{
            $(`#password-error2`).attr('hidden', true);
        }
        

        return valido;
    }




    function registrar(event) {
        event.preventDefault();

        const formData = {
            nombre: $('#nombre').val().trim(),
            apellido: $('#apellido').val().trim(),
            numero: $('#telefono').val().trim(),
            correo: $('#email').val().trim(),
            password: $('#password').val(),
            confpassword: $('#confirm-password').val(),
            sucursal: $('#sucursal').val()
        };

        if (validarFormulario(formData)) {
            $.ajax({
                url:,
                data: formData,
                type:'POST',
                headers:{
                    
                }
            })
        }else{
            console.log("Formulario invalido");
        }

    }
  </script>