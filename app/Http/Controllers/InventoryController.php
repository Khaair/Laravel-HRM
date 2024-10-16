<?php



namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InventoryController extends Controller
{
    // Display the inventory listing
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Inventory::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm editInventory">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteInventory">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('inventory.index');
    }

    // Store a newly created inventory item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        Inventory::updateOrCreate(
            ['id' => $request->inventory_id],
            [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]
        );

        return response()->json(['success' => 'Inventory item saved successfully.']);
    }

    // Edit an inventory item
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return response()->json($inventory);
    }

    // Delete an inventory item
    public function destroy($id)
    {
        Inventory::find($id)->delete();
        return response()->json(['success' => 'Inventory item deleted successfully.']);
    }
}
