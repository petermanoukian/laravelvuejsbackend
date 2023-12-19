<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blog;


class Blogcat extends Model
{
    protected $fillable =['name' ,'catid'];
	
	public function blogcat()
    {
        return $this->belongsTo('App\Blogcat', 'catid' , 'id');
    }
	public function subcats()
    {
    	return $this->hasMany('App\Blogcat', 'catid' , 'id');
	}
	
	public function blogs()
    {
    	return $this->hasMany('App\Blog', 'catid' , 'id');
	}
	
	public function bloggs()
    {
    	return $this->hasMany('App\Blog', 'subid' , 'id');
	}
	
}
