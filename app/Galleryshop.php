<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shoper;

class Galleryshop extends Model
{
    protected $fillable =['name' ,'shopid', 'logo'];
	
    public function shoper()
    {
        return $this->belongsTo('App\Shoper', 'shopid' , 'id');
    }
}
