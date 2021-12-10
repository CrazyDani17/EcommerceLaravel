<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DB;

class Product extends Model
{
	protected $guarded = [];

	public function getStatusLabelAttribute()
	{
	    if ($this->status == 0) {
	        return '<span class="badge badge-secondary">Draft</span>';
	    }
	    return '<span class="badge badge-success">Published</span>';
	}

	public function setSlugAttribute($value)
	{
	    $this->attributes['slug'] = Str::slug($value); 
	}
	public function category()
	{
	    return $this->belongsTo(Category::class);
	}

	public function customer(){
        return $this->belongsToMany(Customer::class);
    }

	public function order(){
        return $this->belongsToMany(Order::class, 'order_details', 'product_id', 'order_id');
    }

	public function isFavorited($id){
		$exists = $this->customer->contains($id);
		if($exists){
			return true;
		}
	    return false;
	}

	public function discounts(){
        return $this->belongsToMany(Discount::class);
    }

	public function coupons(){
        return $this->belongsToMany(Coupon::class);
    }

	public function free_for_packs(){
        return $this->belongsToMany(FreeForPack::class);
    }
}
