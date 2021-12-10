<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'order_id', 'product_id')->withPivot('qty');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery_guy()
    {
        return $this->belongsTo(Delivery_guy::class);
    }



}
