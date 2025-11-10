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

    function merge_rules($rules, $suffix)
    {
        $output_rules = array_merge($rules, [
            //"child-name_{$suffix}"        => 'required|string|max:255',
            //"child-qty_{$suffix}"         => 'required|integer|min:1',
            // "child-unit-price_{$suffix}"  => 'required|numeric|min:0',
            // "child-total-price_{$suffix}" => 'required|numeric|min:0',
            // "child-image_{$suffix}"       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // "child-date_{$suffix}"        => 'required|date', // ordered date
            "inspection_{$suffix}"        => 'nullable|string|max:1000',
            "pm_remarks_{$suffix}"        => 'nullable|string|max:1000',
            "eta_{$suffix}"               => 'nullable|date',
            "ata_{$suffix}"               => "nullable|date|after_or_equal:eta_{$suffix}",
        ]);

        return $output_rules;
    }

    function createChildElement($request, $suffix, $productionRequest, $product_child_element, $order_id)
    {
        if ($request->has("child-name_{$suffix}")) {
            ProductionRequestChildElement::create([
                'po_id' => $productionRequest->id,
                'child_element_id' => $request->input('product_child_element_id') != 0
                    ? $request->input('product_child_element_id')
                    : $product_child_element->id,
                // 'name' => $request->input("child-name_{$suffix}"),
                // 'quantity' => $request->input("child-qty_{$suffix}"),
                // 'unit_price' => $request->input("child-unit-price_{$suffix}"),
                // 'total_price' => $request->input("child-total-price_{$suffix}"),
                // 'image' => $request->file("child-image_{$suffix}")
                //     ? $request->file("child-image_{$suffix}")
                //     ->store("child_images/{$order_id}/{$product_child_element->id}", 'public')
                //     : null,
                // 'date_order' => $request->input("child-date_{$suffix}"),
                'inspection_remarks' => $request->input("inspection_{$suffix}"),
                'production_manager_remarks' => $request->input("pm_remarks_{$suffix}"),
                'eta_child' => $request->input("eta_{$suffix}"),
                'ata_child' => $request->input("ata_{$suffix}"),
            ]);
        }
    }

    function updateChildElement($request, $suffix, $production_request_child_element, $order_id)
    {
        if($request->has("child-name_{$suffix}")){
            $production_request_child_element->update([
                // 'name' => $request->input("child-name_{$suffix}"),
                // 'quantity' => $request->input("child-qty_{$suffix}"),
                // 'unit_price' => $request->input("child-unit-price_{$suffix}"),
                // 'total_price' => $request->input("child-total-price_{$suffix}"),
                // 'image' => $request->file("child-image_{$suffix}")
                //     ? $request->file("child-image_{$suffix}")
                //     ->store("child_images/{$order_id}/" . $request->input("child-item-id"), 'public')
                //     : $production_request_child_element->image,
                // 'date_order' => $request->input("child-date_{$suffix}"),
                'inspection_remarks' => $request->input("inspection_{$suffix}"),
                'production_manager_remarks' => $request->input("pm_remarks_{$suffix}"),
                'eta_child' => $request->input("eta_{$suffix}"),
                'ata_child' => $request->input("ata_{$suffix}"),
            ]);
        }
    }



    public function update_eta_ata(Request $request)
    {
        $rules = [
            'order_id' => 'required|integer|exists:production_requests,id',
            'product_child_element_id' => 'required|integer',
            'product_id' => 'required|integer|exists:products,id',
        ];

        if ($request->has('child-name_one')) {
            $rules = $this->merge_rules($rules, 'one');
        }

        if ($request->has('child-name_two')) {
            $rules = $this->merge_rules($rules, 'two');
        }

        if ($request->has('child-name_three')) {
            $rules = $this->merge_rules($rules, 'three');
        }

        if ($request->has('child-name_four')) {
            $rules = $this->merge_rules($rules, 'four');
        }

        if ($request->has('child-name_five')) {
            $rules = $this->merge_rules($rules, 'five');
        }

        if ($request->has('child-name_six')) {
            $rules = $this->merge_rules($rules, 'six');
        }

        // Validate the request
        $request->validate($rules);

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

            $this->createChildElement($request, 'one', $productionRequest, $product_child_element, $order_id);
            $this->createChildElement($request, 'two', $productionRequest, $product_child_element, $order_id);
            $this->createChildElement($request, 'three', $productionRequest, $product_child_element, $order_id);
            $this->createChildElement($request, 'four', $productionRequest, $product_child_element, $order_id);
            $this->createChildElement($request, 'five', $productionRequest, $product_child_element, $order_id);
            $this->createChildElement($request, 'six', $productionRequest, $product_child_element, $order_id);
        } else {
            $this->updateChildElement($request, 'one', $production_request_child_element, $order_id);
            $this->updateChildElement($request, 'two', $production_request_child_element, $order_id);
            $this->updateChildElement($request, 'three', $production_request_child_element, $order_id);
            $this->updateChildElement($request, 'four', $production_request_child_element, $order_id);
            $this->updateChildElement($request, 'five', $production_request_child_element, $order_id);
            $this->updateChildElement($request, 'six', $production_request_child_element, $order_id);
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
            //$qrData = 'http://127.0.0.1:8000/orders/single_order/' . $id;
            $qrData = url('/orders/single_order/' . $id);

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
