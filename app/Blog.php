<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blogcat;
use App\User;

class Blog extends Model
{
    protected $fillable =['name' ,'catid', 'subid', 'userid', 'description' ,'logo'];
    public function blogcat()
    {
        return $this->belongsTo('App\Blogcat', 'catid' , 'id');
    }
	public function blogsub()
    {
        return $this->belongsTo('App\Blogcat', 'subid' , 'id');
    }
	public function user()
    {
        return $this->belongsTo('App\User', 'userid' , 'id');
    }
	
	
}
