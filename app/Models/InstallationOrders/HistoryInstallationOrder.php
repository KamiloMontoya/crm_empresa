<?php
namespace App\Models\InstallationOrders;

use Illuminate\Database\Eloquent\Model;
use Storage;

class HistoryInstallationOrder extends Model
{   
    

    public function user()
    {
        return $this->hasOne(\App\User::class,  'id', 'user_id');
    }

    public function installationOrder()
    {
        return $this->belongsTo(\App\Models\InstallationOrders\InstallationOrder::class,  'id', 'installation_order_id');
    }

    public function getFiles()
    {	
    	$files = array();
    	$_files = Storage::files('public/installation_orders/'.$this->installation_order_id.'/'.$this->id);

    	foreach ($_files as $f) {
    		$files[] = array(
    			'url' => Storage::url($f),
    			'name' => basename($f)
    		);
    	}
        return $files ;
    }
    

}