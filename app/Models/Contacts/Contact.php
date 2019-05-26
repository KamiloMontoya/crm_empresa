<?php

namespace App\Models\Contacts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{	
	use SoftDeletes;
   	

   	public function contactHasService()
    {
        return $this->hasMany(\App\Models\ContactHasServices\ContactHasService::class, 'contact_id', 'id');
    }
}