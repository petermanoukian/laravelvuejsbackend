<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;

class Servicesub extends Model
{
    protected $fillable =['name' ,'servid', 'logo'];
	
    public function service()
    {
        return $this->belongsTo('App\Service', 'servid' , 'id');
    }
}
