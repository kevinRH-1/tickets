<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ticketshardwareExport implements FromCollection, WithMapping, ShouldAutoSize
{

    public $reportes;

    public function __construct($reportes)
    {
        $this->reportes = $reportes;
    }

    protected $index =0;



    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->reportes;
    }

    public function map($reportes):array{

        if($this->index ==0){
            $result = [
                [
                    'CODIGO', 'SUCURSAL/DEPARTAMENTO', 'USUARIO', 'TIPO', 'EQUIPO', 'PROBLEMA', 'FECHA_CREACION',
                     'FECHA_SOLUCION', 'TIEMPO (HORAS)', 'TECNICO'
                ]
            ];
        }
        $this->index++;

        if($reportes->tiempo_solucion != null){
            $fecha1 = $reportes->created_at;
            $fecha2 = $reportes->tiempo_solucion;

            $diferenciaEnMinutos = $fecha1->diffInMinutes($fecha2);
            $diferenciaEnHoras = $diferenciaEnMinutos / 60; // Convierte a horas
            $tiempo = number_format($diferenciaEnHoras, 2);
        }else{
            $tiempo = 'sin solucion';
        };

        if($reportes->pc){
            $tipo = $reportes->pc->categoria->name;
            $equipo= $reportes->pc->descripcion;
        }elseif($reportes->laptop){
            $tipo = $reportes->laptop->categoria->name;
            $equipo= $reportes->laptop->descripcion;
        }elseif($reportes->impresora){
            $tipo = $reportes->impresora->categoria->name;
            $equipo= $reportes->impresora->descripcion;
        }

        $result[]=[
            $reportes['codigo'],
            $reportes->usuario->sucursal->nombre,
            $reportes->usuario->descripcion,
            $tipo,
            $equipo,
            isset($reportes->falla)? $reportes->falla->desc : 'no es problema comun',
            $reportes->created_at->format('d/m/Y'),
            isset($reportes)? $reportes->tiempo_solucion : 'sin solucionar',
            $tiempo,
            isset($reportes->tecnico)? $reportes->tecnico->descripcion : 'sin tecnico',
        ];

        return $result;
    }


}
