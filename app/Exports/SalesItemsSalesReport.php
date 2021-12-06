<?php
namespace App\Exports;

use App\Http\Model\StockTransferHeader;
use App\Http\Model\StockTransferItems;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesItemsSalesReport implements FromView
{
    protected $result;

    function __construct($result) {
        $this->result = $result;
    }

    public function view(): View
    {
        return view('admin.reports.ExportSalesItemsSalesReport', [
            'result' => $this->result
        ]);
    }
}