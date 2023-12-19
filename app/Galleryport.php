<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Portfolio;

class Galleryport extends Model
{
    protected $fillable =['name' ,'portid', 'logo'];
	
    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio', 'portid' , 'id');
    }
}
