$(document).ready(function (){

    function fetchInvoices(page = 1) {
        $.ajax({
            url: `/api/invoices?page=${page}`,
            method: 'GET',
            success: function (data) {
                let rows = '';
                data.data.forEach(function (invoice) {
                    rows += `<tr>
                                <td class="py-2 px-2 border">${invoice.invoice_number}</td>
                                <td class="py-2 px-2 border">${invoice.customer_name}</td>
                                <td class="py-2 px-2 border">${invoice.address}</td>
                                <td class="py-2 px-2 border">${invoice.invoice_date}</td>
                                <td class="py-2 px-2 border">
                                    <button class="btn edit-invbtn btn-sm" data-id="${invoice.id}">Edit</button>
                                     <button class="btn view-btn btn-sm" data-id="${invoice.id}">View</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${invoice.id}">Delete</button>
                                </td>
                             </tr>`;
                });
                $('#invoice tbody').html(rows);
    
                // Create pagination
                let pagination = `<nav><ul class="pagination justify-content-end">`;
    
                // Previous button
                if (data.current_page > 1) {
                    pagination += `<li class="page-item">
                       <a class="page-link" href="#" data-page="${data.current_page - 1}">Previous</a>
                    </li>`;
                }
    
                // Page numbers
                for (let i = 1; i <= data.last_page; i++) {
                    pagination += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                      <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>`;
                }
    
                // Next button
                if (data.current_page < data.last_page) {
                    pagination += `<li class="page-item">
                        <a class="page-link" href="#" data-page="(${data.current_page + 1})">Next</a>
                    </li>`;
                }
    
                pagination += `</ul></nav>`;
                $('#pagination').html(pagination);
            },
            error: function (err) {
                console.error('Error fetching invoices:', err);
            }
        });
    }
    
    
    

    // Initial fetch
    fetchInvoices();

    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        const page = $(this).data('page');
        fetchInvoices(page);
    });


    $('#invoiceForm').on('submit', function (e) {
        e.preventDefault();
        var data = {
            invoice_number: $('#costumerID').val(),
            customer_name : $('#customerName').val(),
            address: $('#customerAddress').val(),
            invoice_date: $('#invoiceDate').val()        
        }
        $.ajax ({
            url: '/api/invoices/create-invoice',
            method: 'POST',
            data: data,
            success: function(invoices){
                const id = invoices.data.id; 
                setTimeout(function (){    
                // console.log(invoices)
                console.log(invoices.data)
                window.location.href = `/invoiceinfo/${id}?action=add`;
                $('#trnInvoiceModal').modal('hide');
                $('#invoiceForm')[0].reset();
                fetchInvoices();
                },500)
            }
        })

    });


    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');

        // $('#confirmationModal').modal('show');

      //  $('#confirmDelete').off('click').on('click', function () {
            $.ajax({
                url: '/api/invoices/delete-invoice/' + id,
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () {
                    setTimeout(function () {
                        // $('#confirmationModal').modal('hide');
                        // showMessageModal('Student deleted successfully.', 'success');
                         fetchInvoices();
                    }, 500);
                },
                // error: function () {
                //     showMessageModal('Failed to delete student.', 'error');
                // }
            });
      //  });
    });
  
    // $(document).on('click', '#save_Data', function (){

    //     const id = $('#InvoiceID').val();
    //     var data = 
    //     {
    //       customer_name : $('#customerName').val(),
    //       address: $('#customerAddress').val(),
    //       invoice_date: $('#invoiceDate').val(),    
    //       invoice_id: $('#invoiceNumber').val()
    //     }
    //       console.log(data)
    //       $.ajax({
    //           url: '/api/invoices/update-invoice/' + id,
    //           method: 'PUT',
    //           data: data,
    //           success: function () {
    //             setTimeout(function (){
    //                 console.log("success par")
    //             },500);
             
    //         }
    //     }) 
    // });
    $(document).on('click', '#save_Data', function () {

        const id = $('#InvoiceID').val();
    
        // Build the invoice data
        var data = {
            customer_name: $('#customerName').val(),
            address: $('#customerAddress').val(),
            invoice_date: $('#invoiceDate').val(),
            items: []
        };
    
        // Loop through each row of invoice items
        $('#invoiceItemsBody tr').each(function () {
            const description = $(this).find('.description').val();
            const quantity = $(this).find('.quantity').val();
            const unit_price = $(this).find('.unit_price').val();
    
            if (description && quantity && unit_price) {
                const item = {
                    description: description,
                    quantity: parseInt(quantity),
                    unit_price: parseFloat(unit_price)
                };
    
                // Optional: if you're editing and have item IDs stored in a hidden input
                const itemIdInput = $(this).find('.item-id');
                if (itemIdInput.length && itemIdInput.val()) {
                    item.id = itemIdInput.val();
                }
    
                data.items.push(item);
            }
        });
    
        console.log(data); // Debug before sending
    
        $.ajax({
            url: '/api/invoices/update-invoice/' + id,
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                console.log("Update success:", response);
                // Show success message or redirect, etc.
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    });
    
    
    
    $(document).on('click', '.edit-invbtn', function () {
        var id = $(this).data('id');
          window.location.href = `/invoiceinfo/${id}?action=edit`;
    });
    $(document).on('click', '.view-btn', function () {
        const id = $(this).data('id');
        window.location.href = `/invoiceinfo/${id}?action=view`;
    }); 

    function updateLineNumbersAndNames() {
        $('#invoiceItemsBody tr').each(function(index) {
            $(this).find('.line-number').text(index + 1);
            $(this).find('input.description').attr('name', `items[${index}][description]`);
            $(this).find('input.quantity').attr('name', `items[${index}][quantity]`);
            $(this).find('input.unit_price').attr('name', `items[${index}][unit_price]`);
        });
    }

    $(document).on('click', '.removeItem', function () {
        $(this).closest('tr').remove();
        updateLineNumbersAndNames();
    });

    function calculateRowSubtotal(row) {
        const qty = parseFloat(row.find('.quantity').val()) || 0;
        const price = parseFloat(row.find('.unit_price').val()) || 0;
        const subtotal = (qty * price).toFixed(2);
        row.find('.subtotal').val(subtotal);
        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        $('#invoiceItemsTable tbody tr').each(function () {
            const subtotal = parseFloat($(this).find('.subtotal').val()) || 0;
            total += subtotal;
        });
        $('#grandTotal').text(total.toFixed(2));
    }

    $('#addItem').on('click', function () {
        const newRow = `
            <tr>
                <td class="line-number"></td>
                <td><input type="text" class="form-control description" required></td>
                <td><input type="number" class="form-control quantity" min="1" value="1" required></td>
                <td><input type="number" class="form-control unit_price" min="0" step="0.01" value="0.00" required></td>
                <td><input type="text" class="form-control subtotal" readonly value="0.00"></td>
                <td><button type="button" class="btn btn-sm btn-danger removeItem">x</button></td>
            </tr>
        `;
        $('#invoiceItemsBody').append(newRow);
        updateLineNumbersAndNames();
    });
    $('#invoiceItemsTable').on('input', '.quantity, .unit_price', function () {
        const row = $(this).closest('tr');
        calculateRowSubtotal(row);
    });

    $('#invoiceItemsTable').on('click', '.removeItem', function () {
        $(this).closest('tr').remove();
        calculateTotal();
    });
   
})

