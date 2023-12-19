<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Portfolio;


class City extends Model
{
    protected $fillable =['name'];
	
	public function portfolios()
    {
    	return $this->hasMany('App\Portfolio', 'cityid' , 'id');
	}
}
