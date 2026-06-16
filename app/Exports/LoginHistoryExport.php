<?php

namespace App\Exports;

use App\Models\Login;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoginHistoryExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Login::whereNotNull('name')
            ->where('name', '<>', '')
            ->whereNotNull('email')
            ->where('email', '<>', '')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function map($login): array
    {
        return [
            $login->name,
            $login->email,
            "'{$login->mobile_no}",
            optional($login->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s'),
            optional($login->updated_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile Number',
            'Created At',
            'Updated At',
        ];
    }
}
