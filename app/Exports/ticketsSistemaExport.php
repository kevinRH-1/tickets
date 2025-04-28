<?php

namespace App\Exports;

use App\Models\ReportesSoftware;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ticketsSistemaExport implements FromCollection, WithMapping, ShouldAutoSize
{

    public $reportes;

    public function __construct($reportes)
    {
        $this->reportes = $reportes;
    }
    


    protected $index = 0;


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
                    'CODIGO', 'SUCURSAL/DEPARTAMENTO', 'USUARIO', 'SISTEMA', 'MODULO', 'PROBLEMA', 'FECHA_CREACION',
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

        $result[]=[
            $reportes['codigo'],
            $reportes->usuario->sucursal->nombre,
            $reportes->usuario->descripcion,
            $reportes->sistema->nombre,
            isset($reportes->modulo) ? $reportes->modulo->nombre : 'sin modulo',
            isset($reportes->falla)? $reportes->falla->descripcion : 'no es problema comun',
            $reportes->created_at->format('d/m/Y'),
            isset($reportes)? $reportes->tiempo_solucion : 'sin solucionar',
            $tiempo,
            isset($reportes->tecnico)? $reportes->tecnico->descripcion : 'sin tecnico',
        ];

        return $result;
    }

}
