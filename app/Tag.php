<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Portfoliotag;

class Tag extends Model
{
    protected $fillable =['name'];
	
	
	
	public function portfoliotags()
    {
    	return $this->hasMany('App\Portfoliotag', 'tagid' , 'id');
	}
}

