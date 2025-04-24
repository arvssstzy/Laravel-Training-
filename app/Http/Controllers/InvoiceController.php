<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $invoice =Invoice::all();
            return response()->json($invoice);      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get the last invoice record from the database to generate the next ID
        $lastInvoice = DB::table('invoices')->orderBy('id', 'desc')->first();
        $nextId = $lastInvoice ? $lastInvoice->id + 1 : 1;
    
        // Generate the formatted ID like 'INV-00001'
        $formattedId = 'INV-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
    
        $invoice = Invoice::create([
            "invoice_number" => $formattedId,  // Store the generated formatted ID
            "customer_name" => $request->customer_name,
            "address" => $request->address,
            "invoice_date" => $request->invoice_date,
        ]);
    
        // Return a success response
        return response()->json(["message" => "Successfully inserted", "data" => $invoice], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
           // Find the invoice using the provided id
    $invoice = Invoice::find($id);
    
    // Check if the invoice is not found
    if (!$invoice) {
        return response()->json(["message" => "not found"], 404);
    }

    // If the invoice is found, return the response
    return response()->json(["message" => "invoice is available", "data" => $invoice], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    //     $invoice = Invoice::find($id);
    //     if(!$invoice || is_null( $invoice)) return response()->json(["message" => "not found"], 404);

    //     if($invoice)
    //     {
    //         $invoice->update(
    //             $request->all()
    //         );
            
    //         return response()->json(["message" => "updated successfully", "data" => $invoice], 200);
    //     }

    // }

public function update(Request $request, string $id)
{
    $invoice = Invoice::find($id);
    if (!$invoice) {
        return response()->json(["message" => "Invoice not found"], 404);
    }

    DB::beginTransaction();
    try {
        // Update header
        $invoice->update($request->only(['customer_name', 'address', 'invoice_date'])); // adjust based on your actual fields

        // Update details
        if ($request->has('items')) {
            foreach ($request->items as $itemData) {
                if (isset($itemData['id'])) {
                    // Update existing item
                    $item = InvoiceItem::where('invoice_id', $invoice->id)->where('id', $itemData['id'])->first();
                    if ($item) {
                        $item->update([
                            'description' => $itemData['description'],
                            'quantity' => $itemData['quantity'],
                            'unit_price' => $itemData['unit_price'],
                        ]);
                    }
                } else {
                    // Add new item
                    $invoice->items()->create([
                        // 'invoice_id' -> $invoice->$invoice_number,
                        'description' => $itemData['description'],
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $itemData['unit_price'],
                    ]);
                }
            }
        }

        DB::commit();

        return response()->json(["message" => "Updated successfully", "data" => $invoice->load('items')], 200);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(["message" => "Update failed", "error" => $e->getMessage()], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice || is_null( $invoice)) return response()->json(["message" => "not found"], 404);

        if($invoice){
            $invoice->delete();
            return response()->json(["message" => "Successfully Deleted", "data" => $invoice], 200);
        }
    }
    public function getInvoices()
    {
        $invoices = Invoice::paginate(10); // 10 invoices per page
        return response()->json($invoices);
    }

    public function invoiceinfo($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoiceinfo', compact('invoice'));
    }
}
