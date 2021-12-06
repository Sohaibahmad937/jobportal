<?php
namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportReportFromArray implements FromArray,WithHeadings
{
    protected $result;
    protected $headings;
    function __construct($result,$headings) {
        $this->result = $result;
        $this->headings = $headings;
    }
    public function array(): array
    {
        return $this->result;
    }
    public function headings(): array
    {
        return $this->headings;
    }
}