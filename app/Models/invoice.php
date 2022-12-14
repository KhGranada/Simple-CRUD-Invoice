<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  protected $guarded = [];

  public function details()
  {
    return $this->hasMany(InvoiceDetails::class);
  }

  public function discountResult()
  {
    return $this->discount_type == 'fixed' ? $this->discount_value :  $this->discount_value . '%';
  }
}
