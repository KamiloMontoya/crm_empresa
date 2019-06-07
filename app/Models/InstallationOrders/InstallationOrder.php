<?php
namespace App\Models\InstallationOrders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstallationOrder extends Model
{	
	use SoftDeletes;

	const ESTADO_DISPONIBLE = 'disponible';
	const ESTADO_PORGRAMADO = 'programado';
	const ESTADO_FINALIZADO = 'finalizado';
	const ESTADO_QUIEBRE    = 'quiebre';

	public function contactHasService()
    {
        return $this->hasOne(\App\Models\ContactHasServices\ContactHasService::class,  'id', 'contact_has_service_id');
    }

    public static  function getStatus()
    {
        return array(
        	self::ESTADO_DISPONIBLE => self::ESTADO_DISPONIBLE,
        	self::ESTADO_PORGRAMADO => self::ESTADO_PORGRAMADO,
        	self::ESTADO_FINALIZADO => self::ESTADO_FINALIZADO,
        	self::ESTADO_QUIEBRE => self::ESTADO_QUIEBRE
        );
    }

}