<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Delivery_guy extends Authenticatable
{
	use Notifiable;
    protected $guarded = [];

    public function setPasswordAttribute($value)
	{
	    $this->attributes['password'] = bcrypt($value);
	}
}