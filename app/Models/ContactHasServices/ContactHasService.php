<?php

namespace App\Models\ContactHasServices;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactHasService extends Model
{	
	use SoftDeletes;

	public function contact()
    {
        return $this->hasOne(\App\Models\Contacts\Contact::class,  'id', 'contact_id');
    }

    public function service()
    {
        return $this->hasOne(\App\Models\Services\Service::class,  'id', 'service_id');
    }

  
   
}