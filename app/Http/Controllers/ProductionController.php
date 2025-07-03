<?php

namespace App\Http\Controllers;
use App\Models\ProductionRequest;
use App\Http\Requests\StoreProductionRequest;


class ProductionController extends Controller
{
    public function index()
    {

        $data = ProductionRequest::all();

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
