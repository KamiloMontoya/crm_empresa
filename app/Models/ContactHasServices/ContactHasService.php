<?php

namespace App\Models\ContactHasServices;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactHasService extends Model
{	
	use SoftDeletes;

	const ESTADO_ACTIVO = 'activo';
	const ESTADO_SUSPENDIDO = 'suspendido';
	const ESTADO_CANCELADO    = 'cancelado';

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
        return array(
        	self::ESTADO_ACTIVO => self::ESTADO_ACTIVO,
        	self::ESTADO_SUSPENDIDO => self::ESTADO_SUSPENDIDO,
        	self::ESTADO_CANCELADO => self::ESTADO_CANCELADO
        );
    }

    public static  function getDefaultStatus()
    {
        return self::ESTADO_ACTIVO ;
    }

  
   
}