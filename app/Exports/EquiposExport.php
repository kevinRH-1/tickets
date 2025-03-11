<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquiposExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $equipos;

    protected $tipo;

    public function __construct($equipos, $tipo)
    {
        $this->equipos = $equipos;
        $this->tipo = $tipo;
    }

    public function collection()
    {
        return $this->equipos->map(function ($equipo) {

            if($this->tipo==0){

                $tipoequipo = match ($equipo->categoria_id) {
                    1 => 'PC',
                    2 => 'LAPTOP',
                    default => 'IMPRESORA',
                };
    
                
    
                return [
                    'Código' => $equipo->codigo,
                    'Lugar' => $equipo->lugar->nombre,
                    'Descripción' => $equipo->descripcion,
                    'Tipo de Equipo' => $tipoequipo,
                    'Estado' => $equipo->estado->descripcion,
                ];

            }elseif($this->tipo==1){
                $tipoequipo = match ($equipo->categoria_id) {
                    1 => 'PC',
                    2 => 'LAPTOP',
                    3 => 'IMPRESORA',
                };
                return [
                    'CODIGO' => $equipo->codigo,
                    'SUCURSAL/DEPARTAMENTO' => $equipo->lugar->nombre,
                    'NOMBRE' => $equipo->descripcion,
                    'TIPO DE EQUIPO' => $tipoequipo,
                    'MARCA'=> $equipo->marca,
                    'MODELO'=> $equipo->modelo,
                    'PROCESADOR'=> $equipo->procesador,
                    'RAM'=> $equipo->ram,
                    'ALMACENAMIENTO' => $equipo->almacenamiento,
                    'ESTADO' => $equipo->estado->descripcion,
                ];
            }elseif($this->tipo==2){
                $tipoequipo = match ($equipo->categoria_id) {
                    1 => 'PC',
                    2 => 'LAPTOP',
                    3 => 'IMPRESORA',
                };
                return [
                    'CODIGO' => $equipo->codigo,
                    'SUCURSAL/DEPARTAMENTO' => $equipo->lugar->nombre,
                    'NOMBRE' => $equipo->descripcion,
                    'TIPO DE EQUIPO' => $tipoequipo,
                    'MARCA'=> $equipo->marca,
                    'MODELO'=> $equipo->modelo,
                    'PROCESADOR'=> $equipo->procesador,
                    'RAM'=> $equipo->ram,
                    'ALMACENAMIENTO' => $equipo->almacenamiento,
                    'ESTADO' => $equipo->estado->descripcion,
                ];
            }elseif($this->tipo==3){
                $tipoequipo = match ($equipo->categoria_id) {
                    1 => 'PC',
                    2 => 'LAPTOP',
                    3 => 'IMPRESORA',
                };
                return [
                    'CODIGO' => $equipo->codigo,
                    'SUCURSAL/DEPARTAMENTO' => $equipo->lugar->nombre,
                    'NOMBRE' => $equipo->descripcion,
                    'TIPO DE EQUIPO' => $tipoequipo,
                    'MARCA'=> $equipo->marca,
                    'MODELO'=> $equipo->modelo,
                    'ESTADO' => $equipo->estado->descripcion,
                ];
            }
        });
    }

    public function headings(): array
    {   
        if($this->tipo==0){
            return ['CODIGO', 'SUCURSAL/DEPARTAMENTO', 'NOMBRE', 'TIPO DE EQUIPO', 'ESTADO'];
        }elseif($this->tipo==1){
            return ['CODIGO', 'SUCURSAL/DEPARTAMENTO', 'NOMBRE', 'TIPO DE EQUIPO', 'MARCA', 'MODELO', 'PROCESADOR', 'RAM', 'ALMACENAMIENTO', 'ESTADO'];
        }elseif($this->tipo==2){
            return ['CODIGO', 'SUCURSAL/DEPARTAMENTO', 'NOMBRE', 'TIPO DE EQUIPO', 'MARCA', 'MODELO', 'PROCESADOR', 'RAM', 'ALMACENAMIENTO', 'ESTADO'];
        }elseif($this->tipo==3){
            return ['CODIGO', 'SUCURSAL/DEPARTAMENTO', 'NOMBRE', 'TIPO DE EQUIPO', 'MARCA', 'MODELO', 'ESTADO'];
        }else{
            return ['CODIGO', 'SUCURSAL/DEPARTAMENTO', 'NOMBRE', 'TIPO DE EQUIPO', 'ESTADO'];
        }
    }
}
