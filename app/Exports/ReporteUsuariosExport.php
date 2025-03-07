<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReporteUsuariosExport implements FromCollection, WithHeadings, WithStyles, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return User::select('name', 'email')->get();
    }

    public function headings(): array
    {
        return ["Nombre", "Correo Electrónico"];
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:B1')->getFont()->setBold(true); // Negrita en encabezados
        foreach (range('A', 'B') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true); // AutoSize manual
        }
    }
}

