<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = ['invoice_number', 'customer_name', 'address', 'invoice_date'];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
