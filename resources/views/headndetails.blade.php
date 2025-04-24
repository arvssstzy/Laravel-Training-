@extends('components.layout')
@section('content')

<div class="container mt-5 min-vh-100">
    <h2 class="text-center">Create Invoice</h2>

    <button class="btn addtrn-btn mb-3" data-bs-toggle="modal" data-bs-target="#trnInvoiceModal">Add</button>

    <table class="table table-bordered" id="invoice">
        <thead>
            <tr>
                <th>Document No</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div class="d-flex justify-content-end mt-3" id="pagination"></div>
</div>


<div class="modal fade" id="trnInvoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="invoiceModalLabel">Add Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="invoiceForm">
                    <!-- <input type="hidden" id="invoiceId" name="invoiceId"> -->
                    <div class="mb-3">
                        <label for="costumerID" class="form-label">Customer ID</label>
                        <input type="text" class="form-control" id="costumerID" name="costumerID" value="{{ $formattedInvoiceId }}">
                    </div>
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customerName" name="customerName">
                    </div>
                    <div class="mb-3">
                        <label for="customerAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="customerAddress" name="customerAddress">
                    </div>
                    <div class="mb-3">
                            <label for="invoiceDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="invoiceDate" name="date">
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="Editsave">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

