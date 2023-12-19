<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shopcat;
use App\Galleryshop;

class Shoper extends Model
{
    protected $fillable =['name' ,'catid', 'subid', 'prix', 'description' ,'logo'];
    public function shopcat()
    {
        return $this->belongsTo('App\Shopcat', 'catid' , 'id');
    }
	public function shopsub()
    {
        return $this->belongsTo('App\Shopcat', 'subid' , 'id');
    }
	
	public function shopimages()
    {
    	return $this->hasMany('App\Galleryshop', 'shopid' , 'id');
	}

}
