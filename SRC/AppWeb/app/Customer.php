<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
	use Notifiable;
    protected $guarded = [];

    public function setPasswordAttribute($value)
	{
	    $this->attributes['password'] = bcrypt($value);
	}

	public function product()
    {
        return $this->belongsToMany(Product::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
