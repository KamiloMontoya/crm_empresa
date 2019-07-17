<?php

namespace App\Models\ContactHasServices;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactHasService extends Model
{	
	use SoftDeletes;

	const ESTADO_ACTIVO = 'activo';

	public function contact()
    {
        return $this->hasOne(\App\Models\Contacts\Contact::class,  'id', 'contact_id');
    }

    public function service()
    {
        return $this->hasOne(\App\Models\Services\Service::class,  'id', 'service_id');
    }

    public function getHistory()
    {
        return $this->hasMany(\App\Models\ContactHasServices\HistoryContactHasService::class, 'contact_has_service_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function installationOrder()
    {
        return $this->hasOne(\App\Models\InstallationOrders\InstallationOrder::class,  'contact_has_service_id', 'id');
    }

    public function promotion()
    {
        return $this->hasOne(\App\Models\Promotions\Promotion::class, 'id', 'promotion_id');
    }

    public static  function getStatus()
    {
       return \App\Models\Services\ServiceStatus::pluck('service_statuses.name', 'service_statuses.long_name')->toArray();
    }

    public static  function getDefaultStatus()
    {   
        $status = null;

        $default_status = \App\Models\Services\ServiceStatus::where("is_default", "=", 1)->first();
        if($default_status){
            $status = $default_status->name;
        }
        return $status ;
    }

  
   
}