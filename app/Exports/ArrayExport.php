<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArrayExport implements FromArray, WithHeadings {
    protected $array;
    public function __construct(array $array) {
        $this->array = $array;
    }
    public function array(): array {
        return $this->array;
    }
    public function headings(): array {
        return ['id','name','age','class','parent_name','parent_phone','parent_email'];
    }
}
