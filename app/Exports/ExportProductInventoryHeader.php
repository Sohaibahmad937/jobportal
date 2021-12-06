<?php
namespace App\Exports;

use App\Http\Model\ProductInventory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportProductInventoryHeader implements FromView
{
   

    function __construct() {
    }

    public function view(): View
    {
        $ProductInventory = new ProductInventory();
        $result = $ProductInventory->InventoryList();
        return view('admin.product_inventory.export_product_inventory', [
            'result' => $result
        ]);
    }
}