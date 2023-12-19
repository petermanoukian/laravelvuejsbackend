<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use DB;
use Redirect;
use App\Portcat; 
use App\Portfolio; 
use App\Galleryport;
use App\Portfoliotag;

class PortfolioController extends Controller
{
    public function _construct()
    {
        $this->middleware('cors');
    }
	
	
	
	public function search(Request $request)
	{
		

		$request1 = '%' . $request->keywords . '%';
		$hometours= Portfolio::withCount('portfolioimages')->with(['portcat' => function($query){
				$query->select('portcats.id', 'portcats.name');
				}])
				->with(['portcity' => function($query){
				$query->select('cities.id', 'cities.name');}])
				->where('portfolios.name', 'like', $request1 )
				->orwhere('portfolios.description', 'like', $request1 )
				->orderBy('portfolios.id', 'DESC')->paginate(9);	
		
		return response()->json($hometours);
	}
	
	
	
	public function search2(Request $request)
	{
		$request1 = '%' . Input::get('query') . '%';
		$hometours= Portfolio::where('portfolios.name', 'like', $request1 )
		->orderBy('portfolios.id', 'DESC')->get();	
		
		return response()->json($hometours);
	}
	
	public function indexjsonhome($catid='' , $bycitycat='')
	{
		$this->middleware('cors');

		$portcat = array();

		 if($catid != "" && $bycitycat != '')
		 {
		 	if($bycitycat == 'bycat')
			{
				$hometours = Portfolio::withCount('portfolioimages')->with(['portcat' => function($query){
				$query->select('portcats.id', 'portcats.name');
				}]) 
				->with(['portcity' => function($query){
				$query->select('cities.id', 'cities.name');
				}])
				->where('portfolios.catid', '=', $catid)->orderBy('portfolios.id', 'DESC')->limit(8)->get();
			}
			else 	if($bycitycat == 'bycity')
			{
				$hometours = Portfolio::withCount('portfolioimages')->with(['portcity' => function($query){
				$query->select('cities.id', 'cities.name');}])
				->where('portfolios.cityid', '=', $catid)->orderBy('portfolios.id', 'DESC')->limit(8)->get();
			}
		 }

		else
		{
		    $hometours= Portfolio::withCount('portfolioimages')->with(['portcat' => function($query){
		    $query->select('portcats.id', 'portcats.name');
		    }])
			->with(['portcity' => function($query){
			$query->select('cities.id', 'cities.name');}])
			->orderBy('portfolios.id', 'DESC')->limit(8)->get();
		}
		return response()->json($hometours);
	}

	public function detailpublic($galid)
    {
        // dd($galid);
	   $this->middleware('cors');
		//$portdetail = Portfolio::with(['portcat'])->find($id);
		//->first();
        $galdetail = Portfolio::with('portfolioimages')
					
					->with(['portcat' => function($query){
					$query->select('portcats.id', 'portcats.name');
					}]) 
					->with(['portcity' => function($query){
					$query->select('cities.id', 'cities.name');
					}])
					->where('portfolios.id', '=', $galid)->first();
        return response()->json($galdetail);
    }


	public function indexjsonpublic($catid='' , $bycitycat='')
	{
		$this->middleware('cors');

		$portcat = array();

		 if($catid != "" && $bycitycat != '')
		 {
		 	if($bycitycat == 'bycat')
			{
				$hometours = Portfolio::withCount('portfolioimages')->with(['portcat' => function($query){
				$query->select('portcats.id', 'portcats.name');
				}]) 
				->with(['portcity' => function($query){
				$query->select('cities.id', 'cities.name');
				}])
				->where('portfolios.catid', '=', $catid)->orderBy('portfolios.id', 'DESC')->paginate(9);
			}
			else 	if($bycitycat == 'bycity')
			{
				$hometours = Portfolio::withCount('portfolioimages')->with(['portcity' => function($query){
				$query->select('cities.id', 'cities.name');}])
				->where('portfolios.cityid', '=', $catid)->orderBy('portfolios.id', 'DESC')->paginate(9);
			}
			
			else 	if($bycitycat == 'bytag')
			{
				// ->where('portfoliotags.tagid', '=', $catid)
				$hometours = Portfolio::withCount('portfolioimages')->with(['portfoliotags' => function($query) use ($catid){
				$query->select('portfoliotags.tagid')->where('portfoliotags.tagid', '=', $catid);}])
				->orderBy('portfolios.id', 'DESC')->paginate(9);
				
				
				$hometours = DB::table('portfolios')
				->select('portfolios.*')
				
				->join('portfoliotags', 'portfoliotags.portfolioid', '=', 'portfolios.id')
				->where('portfoliotags.tagid', '=', $catid)
				->paginate(9);
			}
			
		 }

		else
		{
		    $hometours= Portfolio::withCount('portfolioimages')->with(['portcat' => function($query){
		    $query->select('portcats.id', 'portcats.name');
		    }])
			->with(['portcity' => function($query){
			$query->select('cities.id', 'cities.name');}])
			->orderBy('portfolios.id', 'DESC')->paginate(9);
		}
		return response()->json($hometours);
	}

	public function indexjsonhomevid($catid='' , $bycitycat='')
	{
		$this->middleware('cors');

		$portcat = array();

		 if($catid != "" && $bycitycat != '')
		 {
		 	if($bycitycat == 'bycat')
			{
				$homevids = Portfolio::withCount('portfolioimages')
				->where('portfolios.url', '<>', NULL)
				->where('portfolios.catid', '=', $catid)->orderBy('portfolios.id', 'DESC')->limit(3)->get();
			}
			else 	if($bycitycat == 'bycity')
			{
				$homevids = Portfolio::withCount('portfolioimages')
				->where('portfolios.url', '<>', NULL)
				->where('portfolios.cityid', '=', $catid)->orderBy('portfolios.id', 'DESC')->limit(3)->get();
			}
		 }

		else
		{
		    $homevids= Portfolio::withCount('portfolioimages')
			->where('portfolios.url', '<>', NULL)
			->orderBy('portfolios.id', 'DESC')->limit(3)->get();
		}
		return response()->json($homevids);
	}
		
	public function indexjson($catid='' , $bycitycat='')
	{
		$this->middleware('cors');
		//$cats= Portcat::orderBy('id', 'DESC')->get();
		
		//$cats =Portfolio::orderBy('id', 'DESC')->paginate(5);
        //return response()->json($response);
		//return response()->json($cats);
		$portcat = array();

		 if($catid != "" && $bycitycat != '')
		 {
		 	if($bycitycat == 'bycat')
			{
				 $porter= Portfolio::withCount('portfolioimages')->with(['portcat' => function($query){
				 $query->select('portcats.id', 'portcats.name');
				  }]) 
				  ->with(['portcity' => function($query){
				 $query->select('cities.id', 'cities.name');
				  }])
				 ->where('portfolios.catid', '=', $catid)->orderBy('portfolios.id', 'DESC')->paginate(15);
			 }
			 else 	if($bycitycat == 'bycity')
			{
				 $porter= Portfolio::withCount('portfolioimages')->with(['portcity' => function($query){
				 $query->select('cities.id', 'cities.name');
				  }])

				 ->where('portfolios.cityid', '=', $catid)->orderBy('portfolios.id', 'DESC')->paginate(15);
			 }
		 }

		else
		{
             
			 $porter= Portfolio::withCount('portfolioimages')->with(['portcat' => function($query){
		     $query->select('portcats.id', 'portcats.name');
		      }])
			  
			   ->with(['portcity' => function($query){
				 $query->select('cities.id', 'cities.name');
				  }])
			  
			  ->orderBy('portfolios.id', 'DESC')->paginate(15);
		}
		return response()->json( $porter);

	}
	
	
	public function indexjsondropdown()
	{
		$this->middleware('cors');
		
		$ports =Portfolio::orderBy('id', 'DESC')->get(['id','name']);
        //return response()->json($response);
		return response()->json($ports);
	}
	
	public function detail($id)
    {
        $this->middleware('cors');
        $portdetail = Portfolio::with(['portcat'])->find($id);
        return response()->json($portdetail);
    }
	
	public function edit($id)
    {
        $this->middleware('cors');
        $port = Portfolio::with(['portcat'])->find($id);
        return response()->json($port);
    }

	
	public function store(Request $request)
	{

	    if($request->post('logo'))
       {
          $image = $request->get('logo');
          $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          // \Image::make($request->get('logo'))->save(public_path('images/').$pic)->resize(100, 100)->save(public_path('images/thumb/').$pic);
		  \Image::make($request->get('logo'))->save(public_path('images/').$pic)->resize(220, 220)->save(public_path('images/thumb/').$pic);
        }
		else
		{
			
			$pic = '';
		}
		/*$port = Portfolio::create($request->all());*/
		
		$port = new Portfolio();
        $port->logo= $pic;
		$port->name = $request->name;
		$port->catid = $request->catid;
		$port->cityid = $request->cityid;
		$port->description = $request->description;
		$port->url = $request->url;
		$port->customer = $request->customer;
		$port->save();
		$tag = $request->tag;
		$LastInsertId = $port->id;
		foreach($tag as $tg)
		{
			DB::table('portfoliotags')->insert(
			['portfolioid' => "$LastInsertId", 'tagid' => "$tg", 'created_at' => now(), 'updated_at' => now()]
			);
		}
		
        return response()->json(" Successfully added");
	}
	public function update(Request $request, $id)
    {
       
    	$this->middleware('cors');
		$port = Portfolio::find($id);
		$tag = $request->tag;
	    if($request->post('image'))
        {
          $image = $request->post('image');
          $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->post('image'))->save(public_path('images/').$pic)->resize(220, 220)->save(public_path('images/thumb/').$pic);
		  	
			$port->logo= $pic;
			$port->name = $request->name;
			$port->catid = $request->catid;
			$port->cityid = $request->cityid;
			$port->description = $request->description;
			$port->url = $request->url;
			$port->customer = $request->customer;
			$port->save();
        }
		else
		{
			$port->update($request->all());
		}
		
		$LastInsertId = $id;
		
		DB::table('portfoliotags')->where('portfolioid', '=', "$LastInsertId")->delete();
		if($tag  != '')
		{
			foreach($tag as $tg)
			{
				if($tg != '' )
				{
					
					DB::table('portfoliotags')->insert(
					['portfolioid' => "$LastInsertId", 'tagid' => "$tg", 'created_at' => now(), 'updated_at' => now()]
					);
					
					
				}
			}
		}

        return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');
		Portfolio::destroy($id);
        return response()->json('Successfully Deleted');
	}
}
