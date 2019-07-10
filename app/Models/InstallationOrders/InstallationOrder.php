<?php
namespace App\Models\InstallationOrders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstallationOrder extends Model
{	
	use SoftDeletes;

	public function contactHasService()
    {
        return $this->hasOne(\App\Models\ContactHasServices\ContactHasService::class,  'id', 'contact_has_service_id');
    }


    public function getHistory()
    {
        return $this->hasMany(\App\Models\InstallationOrders\HistoryInstallationOrder::class, 'installation_order_id', 'id')->orderBy('created_at', 'DESC');
    }

    public static  function getStatus()
    {
       return \App\Models\InstallationOrders\InstallationOrderStatus::pluck('installation_order_statuses.name', 'installation_order_statuses.long_name')->toArray();
    }

}