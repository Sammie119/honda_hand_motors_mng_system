<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getItemId(string $item)
    {
        $item_id = Item::select('item_id')->where('item', $item)->first()->item_id;

        return $item_id;
    }

    protected function updateItemStock($item_id, $stock, $operation)
    {
        $getitem = Item::find($item_id);

        switch ($operation) {
            case 'Add':

                $getitem->stock = $getitem->stock + $stock;

                break;

            case 'Substract':

                $getitem->stock = $getitem->stock - $stock;

                break;
            
            default:
                return "No Operation";
                break;
        }

        $getitem->update();
        return;

    }
}
