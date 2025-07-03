<?php

namespace App\Http\Controllers;

use App\Models\ProductionRequest;
use App\Http\Requests\StoreProductionRequest;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index(Request $request)
    {

        $query = ProductionRequest::query();

        if ($request->has('q') && trim($request->q) !== '') {
            $input = trim($request->q);

            // Extract the numeric part from input (e.g., 1001 from "PO-1001", "po1001")
            preg_match('/(\d+)/', $input, $matches);

            if (!empty($matches[1])) {
                $poInput = (int) $matches[1];   // e.g., 1001
                $idToSearch = $poInput - 1000;  // Reverse logic → id = 1001 - 1000 = 1

                // Filter by id
                $query->where('id', $idToSearch);
            }
        }

        $data = $query->get();

        return view('orders_list')->with([
            'data' => $data
        ]);
    }

    public function store(StoreProductionRequest $request)
    {
        // Validate the request
        $validatedData = $request->validated();


        // Create a new production request
        ProductionRequest::create($validatedData);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Production request created successfully.');
    }
}
