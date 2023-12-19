<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Portfolio;

class Portfoliotag extends Model
{
    protected $fillable =['portfolioid','tagid'];
	
	
	public function portfolios()
    {
        return $this->belongsTo('App\Portfolio', 'portfolioid' , 'id');
    }
	
	public function tags()
    {
        return $this->belongsTo('App\Tag', 'tagid' , 'id');
    }
	
}
