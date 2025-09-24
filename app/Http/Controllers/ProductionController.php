<?php

namespace App\Http\Controllers;

use App\Models\ProductionRequest;
use App\Models\ProductionRequestChildElement;
use App\Http\Requests\StoreProductionRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Imports\PurchaseOrderImport;
use App\Models\ProductChildElement;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                $query->where('id', $idToSearch)->orWhere('po_number', 'PO-' . $poInput);
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

        if (!isset($validatedData['po_number'])) {
            $maxId = ProductionRequest::max('id') ?? 0;
            $poNumber = 'PO-' . (1000 + $maxId + 1);
            $validatedData = array_merge($validatedData, ['po_number' => $poNumber]);
        }

        // Create a new production request
        ProductionRequest::create($validatedData);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Production request created successfully.');
    }

    public function update_eta_ata(Request $request)
    {
        $rules = [
            'order_id' => 'required|integer|exists:production_requests,id',
            'product_child_element_id' => 'required|integer',
            'product_id' => 'required|integer|exists:products,id',
        ];

        if ($request->has('child-name_one')) {
            $rules = array_merge($rules, [
                'child-name_one' => 'required|string|max:255',
                'child-qty_one' => 'required|integer|min:1',
                'child-unit-price_one' => 'required|numeric|min:0',
                'child-total-price_one' => 'required|numeric|min:0',
                'child-image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'child-date_one' => 'required|date', //ordered date
                'inspection_one' => 'required|string|max:1000',
                'pm_remarks_one' => 'required|string|max:1000',
                'eta_one' => 'nullable|date',
                'ata_one' => 'nullable|date|after_or_equal:eta',
            ]);
        }

        if ($request->has('child-name_two')) {
            $rules = array_merge($rules, [
                'child-name_two' => 'required|string|max:255',
                'child-qty_two' => 'required|integer|min:1',
                'child-unit-price_two' => 'required|numeric|min:0',
                'child-total-price_two' => 'required|numeric|min:0',
                'child-image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'child-date_two' => 'required|date', //ordered date
                'inspection_two' => 'required|string|max:1000',
                'pm_remarks_two' => 'required|string|max:1000',
                'eta_two' => 'nullable|date',
                'ata_two' => 'nullable|date|after_or_equal:eta',
            ]);
        }


        // Validate the request

        $request->validate($rules);
        // $request->validate([
        //     'order_id' => 'required|integer|exists:production_requests,id',
        //     'product_child_element_id' => 'required|integer',
        //     'product_id' => 'required|integer|exists:products,id',

        //     'child-name_one' => 'required|string|max:255',
        //     'child-qty_one' => 'required|integer|min:1',
        //     'child-unit-price_one' => 'required|numeric|min:0',
        //     'child-total-price_one' => 'required|numeric|min:0',
        //     'child-image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'child-date_one' => 'required|date', //ordered date
        //     'inspection_one' => 'required|string|max:1000',
        //     'pm_remarks_one' => 'required|string|max:1000',
        //     'eta_one' => 'nullable|date',
        //     'ata_one' => 'nullable|date|after_or_equal:eta',

        // 'child-name_two' => 'required|string|max:255',
        // 'child-qty_two' => 'required|integer|min:1',
        // 'child-unit-price_two' => 'required|numeric|min:0',
        // 'child-total-price_two' => 'required|numeric|min:0',
        // 'child-image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'child-date_two' => 'required|date', //ordered date
        // 'inspection_two' => 'required|string|max:1000',
        // 'pm_remarks_two' => 'required|string|max:1000',
        // 'eta_two' => 'nullable|date',
        // 'ata_two' => 'nullable|date|after_or_equal:eta',
        //]);

        // $validator = Validator::make($request->all(), [
        //     'order_id' => 'required|integer|exists:production_requests,id',
        //     'product_child_element_id' => 'required|integer',
        //     'child-name' => 'required|string|max:255',
        //     'product_id' => 'required|integer|exists:products,id',
        //     'child-qty' => 'required|integer|min:1',
        //     'child-unit-price' => 'required|numeric|min:0',
        //     'child-total-price' => 'required|numeric|min:0',
        //     'child-image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'child-date' => 'required|date', //ordered date
        //     'inspection' => 'required|string|max:1000',
        //     'pm_remarks' => 'required|string|max:1000',
        //     'eta' => 'nullable|date|before_or_equal:ata',
        //     'ata' => 'nullable|date|after_or_equal:eta',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        $order_id = $request->input('order_id');

        $productionRequest = ProductionRequest::find($order_id);

        $product = Product::findOrFail($request->input('product_id'));

        $production_request_child_element = ProductionRequestChildElement::where('po_id', $productionRequest->id)
            ->where('child_element_id', $request->input('product_child_element_id'))
            ->first();

        if (!$production_request_child_element) {

            $product_child_element = ProductChildElement::create([
                'product_id' => $request->input('product_id'),
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
            ]);

            if ($request->has('child-name_one')) {

                ProductionRequestChildElement::create([
                    'po_id' => $productionRequest->id,
                    'child_element_id' => $request->input('product_child_element_id') != 0 ? $request->input('product_child_element_id') : $product_child_element->id,
                    'name' => $request->input('child-name_one'),
                    'quantity' => $request->input('child-qty_one'),
                    'unit_price' => $request->input('child-unit-price_one'),
                    'total_price' => $request->input('child-total-price_one'),
                    'image' => $request->file('child-image_one') ? $request->file('child-image_one')->store('child_images/' . $order_id . '/' . $product_child_element->id, 'public') : null,
                    'date_order' => $request->input('child-date_one'),
                    'inspection_remarks' => $request->input('inspection_one'),
                    'production_manager_remarks' => $request->input('pm_remarks_one'),
                    'eta_child' => $request->input('eta_one'),
                    'ata_child' => $request->input('ata_one'),
                ]);
            }


            if ($request->has('child-name_two')) {

                ProductionRequestChildElement::create([
                    'po_id' => $productionRequest->id,
                    'child_element_id' => $request->input('product_child_element_id') != 0 ? $request->input('product_child_element_id') : $product_child_element->id,
                    'name' => $request->input('child-name_two'),
                    'quantity' => $request->input('child-qty_two'),
                    'unit_price' => $request->input('child-unit-price_two'),
                    'total_price' => $request->input('child-total-price_two'),
                    'image' => $request->file('child-image_two') ? $request->file('child-image_two')->store('child_images/' . $order_id . '/' . $product_child_element->id, 'public') : null,
                    'date_order' => $request->input('child-date_two'),
                    'inspection_remarks' => $request->input('inspection_two'),
                    'production_manager_remarks' => $request->input('pm_remarks_two'),
                    'eta_child' => $request->input('eta_two'),
                    'ata_child' => $request->input('ata_two'),
                ]);
            }
        } else {
            if ($request->has('child-name_one')) {
                $production_request_child_element->update([
                    'name' => $request->input('child-name_one'),
                    'quantity' => $request->input('child-qty_one'),
                    'unit_price' => $request->input('child-unit-price_one'),
                    'total_price' => $request->input('child-total-price_one'),
                    'image' => $request->file('child-image_one') ? $request->file('child-image_one')->store('child_images/' . $order_id . '/' . $request->input('child-item-id'), 'public') : $production_request_child_element->image,
                    'date_order' => $request->input('child-date_one'),
                    'inspection_remarks' => $request->input('inspection_one'),
                    'production_manager_remarks' => $request->input('pm_remarks_one'),
                    'eta_child' => $request->input('eta_one'),
                    'ata_child' => $request->input('ata_one'),
                ]);
            }

            if ($request->has('child-name_two')) {
                $production_request_child_element->update([
                    'name' => $request->input('child-name_two'),
                    'quantity' => $request->input('child-qty_two'),
                    'unit_price' => $request->input('child-unit-price_two'),
                    'total_price' => $request->input('child-total-price_two'),
                    'image' => $request->file('child-image_two') ? $request->file('child-image_two')->store('child_images/' . $order_id . '/' . $request->input('child-item-id'), 'public') : $production_request_child_element->image,
                    'date_order' => $request->input('child-date_two'),
                    'inspection_remarks' => $request->input('inspection_two'),
                    'production_manager_remarks' => $request->input('pm_remarks_two'),
                    'eta_child' => $request->input('eta_two'),
                    'ata_child' => $request->input('ata_two'),
                ]);
            }
        }

        return redirect()->back()->with('success', 'All child elements data updated successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new PurchaseOrderImport, $request->file('file'));

        return back()->with('success', 'Excel file imported successfully.');
    }

    public function generateQR($id, $child_id)
    {
        try {
            $qrData = 'http://127.0.0.1:8000/orders/single_order/' . $id;

            $selectedChildId = null;

            switch ($child_id) {
                case 157:
                    $selectedChildId = 1;
                    break;
                case 158:
                    $selectedChildId = 2;
                    break;
                case 159:
                    $selectedChildId = 3;
                    break;
                case 160:
                    $selectedChildId = 4;
                    break;
                case 161:
                    $selectedChildId = 5;
                    break;
                case 162:
                    $selectedChildId = 6;
                    break;
            }

            //dd($child_id, $selectedChildId);

            $fileName = 'qr_' . $child_id  . '.svg';

            $path = 'qr/' . $fileName;


            if (!Storage::disk('public')->exists($path)) {
                $qrImage = QrCode::format('svg')->size(300)->generate($qrData);
                Storage::disk('public')->put($path, $qrImage);
            }

            $url = asset('storage/' . $path);

            ProductionRequestChildElement::where('po_id', $id)
                ->where('child_element_id', $selectedChildId)
                ->update(['qr' => $path]);

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
