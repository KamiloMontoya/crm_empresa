<?php
namespace App\Models\ContactHasServices;

use Illuminate\Database\Eloquent\Model;
use Storage;

class HistoryContactHasService extends Model
{   
    

    public function user()
    {
        return $this->hasOne(\App\User::class,  'id', 'user_id');
    }

    public function contactHasService()
    {
        return $this->belongsTo(\App\Models\ContactHasServices\ContactHasService::class,  'id', 'contact_has_service_id');
    }

    public function getFiles()
    {	
    	$files = array();
    	$_files = Storage::files('public/contact_has_services/'.$this->contact_has_service_id.'/'.$this->id);
    	foreach ($_files as $f) {
    		$files[] = array(
    			'url' => Storage::url($f),
    			'name' => basename($f)
    		);
    	}
        return $files ;
    }
    

}