@php
    $action = request()->get('action', 'add'); // default is 'add'
    $isReadonly = !in_array($action, ['add', 'edit']); // readonly if not 'add' or 'edit'
@endphp
@extends ('components.layout')
@section('content')
 <div class="container mt-5 min-vh-100">
    <h2>THIS IS INVOICE INFO</h2>
    <input type="hidden" class="form-control control-field" id="InvoiceID" name="InvoiceID" value = "{{ $invoice->id }}">
                      <div class="mb-3">
                        <label for="invoiceNumber" class="form-label">Invoice Number</label>
                        <input type="text" class="form-control control-field" id="invoiceNumber" name="invoiceNumber"  value="{{ $invoice->invoice_number }}" {{ $isReadonly ? 'readonly' : 'readonly' }}>
                    </div>
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Customer Name</label>
                        <input type="text" class="form-control control-field" id="customerName" name="customerName"   value="{{ $invoice->customer_name }}" {{ $isReadonly ? 'readonly' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label for="customerAddress" class="form-label">Address</label>
                        <input type="text" class="form-control control-field" id="customerAddress" name="customerAddress"    value="{{ $invoice->address }}" {{ $isReadonly ? 'readonly' : '' }}>
                    </div>
                    <div class="mb-3">
                            <label for="invoiceDate" class="form-label">Date</label>
                            <input type="date" class="form-control control-field" id="invoiceDate" name="date"  value="{{ $invoice->invoice_date }}" {{ $isReadonly ? 'readonly' : '' }}>
                        </div> 
                        <button type="submit" class="btn btn-primary" id="save_Data">Save</button>

<h4>Invoice Items</h4>
<table class="table table-bordered" id="invoiceItemsTable">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Subtotal</th>
            <th><button type="button" class="btn btn-sm btn-success" id="addItem">+</button></th>
        </tr>
    </thead>
    <tbody id="invoiceItemsBody">
        <tr>
            <td class="line-number">1</td>
            <td><input type="text" name="items[0][description]" class="form-control description" required></td>
            <td><input type="number" name="items[0][quantity]" class="form-control quantity" min="1" value="1" required></td>
            <td><input type="number" name="items[0][unit_price]" class="form-control unit_price" min="0" step="0.01" value="0.00" required></td>
            <td><input type="text" class="form-control subtotal" readonly value="0.00"></td>
            <td><button type="button" class="btn btn-sm btn-danger removeItem">x</button></td>
        </tr>
    </tbody>
</table>

<div class="text-end me-2">
    <strong>Total:</strong> <span id="grandTotal">0.00</span>
</div>
</div>

@endsection
