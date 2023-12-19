<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shoper;

class Shopcat extends Model
{
    protected $fillable =['name' ,'catid'];
	
	public function shopcat()
    {
        return $this->belongsTo('App\Shopcat', 'catid' , 'id');
    }
	public function subcats()
    {
    	return $this->hasMany('App\Shopcat', 'catid' , 'id');
	}
	
	public function shopers()
    {
    	return $this->hasMany('App\Shoper', 'catid' , 'id');
	}
	
	public function shoperrs()
    {
    	return $this->hasMany('App\Shoper', 'subid' , 'id');
	}
}
