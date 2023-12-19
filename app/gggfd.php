<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Portfolio;

class Portfolio_Tag extends Model
{
    protected $fillable =['portfolio_id','tag_id'];
	
	
	public function portfolios()
    {
        return $this->belongsTo('App\Portfolio', 'portfolio_id' , 'id');
    }
	
	public function tags()
    {
        return $this->belongsTo('App\Tag', 'tag_id' , 'id');
    }
	
}
