<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index($film) {
        // Laravel magic for this?
        return response()->json(Inventory::where('film_id', $film)->get()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $film)
    {
        $inventory = Inventory::create([
            'film_id' => $film,
        ]);

        return response()->json([
            'status' => (bool)$inventory,
            'data' => $inventory,
            'message' => $inventory ? 'Inventory Created' : 'Error creating inventory'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Inventory $inventory
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($inventory)
    {
        $inventoryToDelete = Inventory::where('id', $inventory);
        $status = $inventoryToDelete->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Inventory Deleted!' : 'Error Deleting Inventory'
        ]);
    }
}
