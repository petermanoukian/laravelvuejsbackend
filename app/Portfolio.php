<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Portcat;
use App\Galleryport;
use App\Portfoliotag;

class Portfolio extends Model
{
  
    protected $fillable =['name' ,'catid', 'cityid', 'description' ,'logo','url','customer'];
    public function portcat()
    {
        return $this->belongsTo('App\Portcat', 'catid' , 'id');
    }
	
	public function portcity()
    {
        return $this->belongsTo('App\City', 'cityid' , 'id');
    }

  	public function portfolioimages()
    {
    	return $this->hasMany('App\Galleryport', 'portid' , 'id');
	}

	public function portfoliotags()
    {
    	return $this->hasMany('App\Portfoliotag', 'portfolioid' , 'id');
	}

}
