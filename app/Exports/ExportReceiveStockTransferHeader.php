<?php
namespace App\Exports;

use App\Http\Model\StockTransferHeader;
use App\Http\Model\StockTransferItems;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportReceiveStockTransferHeader implements FromView
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function view(): View
    {
        $StockTransferItems = new StockTransferItems();
        $result = $StockTransferItems->Recive_Transfer_Items($this->id);
        $StockTransferHeader = new StockTransferHeader();
        $stock_header = $StockTransferHeader->StockTransferHeaderInfo($this->id);
        return view('admin.stock_transfer.export_stock_transfer_header', [
            'result' => $result,
            'stock_header' => $stock_header
        ]);
    }
}