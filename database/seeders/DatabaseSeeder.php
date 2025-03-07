<?php

namespace Database\Seeders;

use App\Models\CategoriaFalla;
use App\Models\TipoSolucion;
use App\Models\User;
use App\Models\Sucursal;
use App\Models\Roles;
use App\Models\CategoriasEquipos;
use App\Models\EstadosEquipos;
use App\Models\equipos\Pc;
use App\Models\equipos\Impresoras;
use App\Models\equipos\Laptops;
use App\Models\Importancias;
use App\Models\Modulos;
use App\Models\Sistemas;
use App\Models\statusReporte;
use App\Models\TipoFalla;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $sucursal = new Sucursal();

        $sucursal->id =1;
        $sucursal->nombre ='sin sucursal';
        $sucursal->activo=1;

        $sucursal->save();

        $sucursal2 = new Sucursal();

        $sucursal2->id=2;
        $sucursal2->nombre='vzla';
        $sucursal2->activo=1;
        $sucursal2->save();

        $sucursal3 = new Sucursal();

        $sucursal3->id=3;
        $sucursal3->nombre='bqto';

        $sucursal3->save();

        $rol1 = new Roles();

        $rol1->id = 1;
        $rol1->nombre = 'admin';

        $rol1->save();

        $rol2 = new Roles();
        $rol2->id = 2;
        $rol2->nombre ='tecnico';

        $rol2->save();

        $rol3 = new Roles();
        $rol3->id =3;
        $rol3->nombre = 'usuario';
        $rol3->save();

        $cat1 = new CategoriasEquipos();
        $cat1->id = 1;
        $cat1->name= 'Pc';
        $cat1->descripcion='computadoras normales';

        $cat1->save();

        $cat2 = new CategoriasEquipos();
        $cat2->id = 2;
        $cat2->name= 'laptop';
        $cat2->descripcion='computadoras portatiles';

        $cat2->save();

        $cat3 = new CategoriasEquipos();
        $cat3->id = 3;
        $cat3->name= 'impresoras';
        $cat3->descripcion='maquinas para imprimir';

        $cat3->save();

        $admin = new User();

        $admin->id = 1;
        $admin->name='administrador';
        $admin->lastname='administrador';
        $admin->number='04245873003';
        $admin->roleid=1;
        $admin->email='admin@gmail.com';
        $admin->password= bcrypt('Kevin2001*');
        $admin->status =1;
        $admin->lugar_id=1;
        $admin->activo=1;

        $admin->save();

        $user = new User();

        $user->id = 2;
        $user->name='tecnico';
        $user->lastname='admin';
        $user->number='04265502089';
        $user->roleid=2;
        $user->email='tecnico@gmail.com';
        $user->password= bcrypt('Kevin2001*');
        $user->status=1;
        $user->lugar_id=2;
        $user->activo=1;

        $user->save();

        $user = new User();

        $user->id = 3;
        $user->name='usuario';
        $user->lastname='admin';
        $user->number='04245503003';
        $user->roleid=3;
        $user->email='user@gmail.com';
        $user->password= bcrypt('Kevin2001*');
        $user->status=1;
        $user->lugar_id=2;
        $user->activo=1;

        $user->save();

        //1
        $estado1 = new EstadosEquipos();

        $estado1->id= 1;
        $estado1->descripcion= 'bueno';

        $estado1->save();


        //2
        $estado2 = new EstadosEquipos();

        $estado2->id= 2;
        $estado2->descripcion= 'con falla';

        $estado2->save();

        //3

        $estado3 = new EstadosEquipos();

        $estado3->id= 3;
        $estado3->descripcion= 'sin uso';

        $estado3->save();

        //4  

        $laptop = new Laptops();
        $laptop->codigo = '01bbb';
        $laptop->lugar_id = 2;
        $laptop->categoria_id = 2;
        $laptop->marca = 'hp';
        $laptop->modelo = 'portatil';
        $laptop->procesador = 'ryzen 3';
        $laptop->ram = '18';
        $laptop->almacenamiento = '0.1tb';
        $laptop->estado_id = 1;
        $laptop->descripcion = 'computadora portatil';
        $laptop->activo=1;

        $laptop->save();

        $pc = new Pc();
        $pc->codigo = '01aaa';
        $pc->lugar_id = 2;
        $pc->categoria_id = 1;
        $pc->marca = 'hp';
        $pc->modelo = 'escritorio';
        $pc->procesador = 'ryzen 9';
        $pc->ram = '8';
        $pc->almacenamiento = '1tb';
        $pc->estado_id = 1;
        $pc->descripcion = 'pc de escritorio';
        $pc->activo=1;

        $pc->save();

        $impresora = new Impresoras();
        $impresora->codigo = '01ccc';
        $impresora->lugar_id = 2;
        $impresora->categoria_id = 3;
        $impresora->marca = 'hp';
        $impresora->modelo = 'negra';
        $impresora->estado_id = 1;
        $impresora->descripcion = 'impresora negra';
        $impresora->activo=1;

        $impresora->save();

        $status1 = new statusReporte();
        $status1->nombre = 'generado';
        $status1->save();

        $status2 = new statusReporte();
        $status2->nombre = 'en revision';
        $status2->save();

        $status3 = new statusReporte();
        $status3->nombre = 'solucionado';
        $status3->save();

        $catefalla1 = new CategoriaFalla();
        $catefalla1->desc = 'falla de sistema';
        $catefalla1->save();

        $catefalla2 = new CategoriaFalla();
        $catefalla2->desc = 'falla fisica';
        $catefalla2->save();

        $falla1 = new TipoFalla();
        $falla1->desc = 'va lento';
        // $falla1->categoria_id =1;
        $falla1->nivel_riesgo = 1;
        $falla1->activo=1;
        $falla1->save();

        $falla2 = new TipoFalla();
        $falla2->desc = 'no internet';
        // $falla2->categoria_id =2;
        $falla2->nivel_riesgo = 2;
        $falla2->activo=1;
        $falla2->save();

        $falla3 = new TipoFalla();
        $falla3->desc = 'no enciende';
        // $falla3->categoria_id =2;
        $falla3->nivel_riesgo = 3;
        $falla3->activo=1;
        $falla3->save();

        $tiposolucion = new TipoSolucion();
        $tiposolucion->descripcion = 'envio de tecnico';
        // $tiposolucion->categoria_id =1;
        $tiposolucion->activo=1;
        $tiposolucion->categoria=2;
        $tiposolucion->save();

        $tiposolucion2 = new TipoSolucion();
        $tiposolucion2->descripcion = 'solucionado por chat';
        // $tiposolucion2->categoria_id = 3;
        $tiposolucion2->activo=1;
        $tiposolucion2->categoria=0;
        $tiposolucion2->save();


        $tiposolucion3 = new TipoSolucion();
        $tiposolucion3->descripcion = 'solucionado por llamada';
        // $tiposolucion3->categoria_id = 3;
        $tiposolucion3->activo=1;
        $tiposolucion3->categoria=0;
        $tiposolucion3->save();

        $tiposolucion4 = new TipoSolucion();
        $tiposolucion4->descripcion = 'cambio en la base de datos';
        // $tiposolucion4->categoria_id = 2;
        $tiposolucion4->activo=1;
        $tiposolucion4->categoria=1;
        $tiposolucion4->save();


        $sistema = new Sistemas();
        $sistema->codigo = 'abc123';
        $sistema->nombre = 'covenca';
        $sistema->activo=1;
        $sistema->save();


        $sistema2 = new Sistemas();
        $sistema2->codigo = '456cba';
        $sistema2->nombre = 'produccion';
        $sistema2->activo=1;
        $sistema2->save();

        $modulo1_1 = new Modulos();
        $modulo1_1->codigo = '123';
        $modulo1_1->nombre = 'garantias creacion';
        $modulo1_1->sistema_id = 1;
        $modulo1_1->activo=1;
        $modulo1_1->save();

        $modulo2_1 = new Modulos();
        $modulo2_1->codigo = '456';
        $modulo2_1->nombre = 'garantias analisis';
        $modulo2_1->sistema_id = 1;
        $modulo2_1->activo=1;
        $modulo2_1->save();

        $modulo1_2 = new Modulos();
        $modulo1_2->codigo = '123';
        $modulo1_2->nombre = 'produccion boletas';
        $modulo1_2->sistema_id = 2;
        $modulo1_2->activo=1;
        $modulo1_2->save();

        $modulo2_2 = new Modulos();
        $modulo2_2->codigo = '456';
        $modulo2_2->nombre = 'produccion recepcionar';
        $modulo2_2->sistema_id = 2;
        $modulo2_2->activo=1;
        $modulo2_2->save();

        $importancia = new Importancias();
        $importancia->descripcion = "bajo";
        $importancia->save();

        $importancia2 = new Importancias();
        $importancia2->descripcion = "medio";
        $importancia2->save();

        $importancia3 = new Importancias();
        $importancia3->descripcion = "alto";
        $importancia3->save();

        $importancia4 = new Importancias();
        $importancia4->descripcion = "extremo";
        $importancia4->save();
    }   
}
