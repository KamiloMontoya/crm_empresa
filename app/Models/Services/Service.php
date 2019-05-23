<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{	
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'description', 'value'];

   
}