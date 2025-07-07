<?php

namespace App\Http\Controllers;

use App\Models\ProductionRequest;
use App\Http\Requests\StoreProductionRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
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

    public function single_order(int $id)
    {
        $production_request = ProductionRequest::findOrFail($id);

        return view('single_order')->with([
            'data' => $production_request,
            'id' => $id
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

    public function generateQR($id)
    {
        try {
            $qrData = 'http://127.0.0.1:8000/orders/single_order/' . $id;

            $fileName = 'qr_' . $id . '.svg';

            $path = 'qr/' . $fileName;


            if (!Storage::disk('public')->exists($path)) {
                $qrImage = QrCode::format('svg')->size(300)->generate($qrData);
                Storage::disk('public')->put($path, $qrImage);
            }

            $url = asset('storage/' . $path);

            return response()->json([
                'success' => true,
                'qr_url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating QR code',
                'error' => $e->getMessage()
            ], 500);
        }


    }
}
