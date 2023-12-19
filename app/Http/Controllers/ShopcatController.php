<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Redirect;
use App\Shopcat; 
use App\Shoper;



class ShopcatController extends Controller
{
    
	public function _construct()
    {
        $this->middleware('cors');
    }
	
	
	public function homejsondropdown($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');
		if($bycat =='bycat')
		{
			$cats =Shopcat::with(['subcats'])

			->where('shopcats.catid', '=', null)
			->orderBy('id', 'DESC')->get();

		}
		
		else if($bycat =='bysub')
		{
			
			if($subid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $subid)
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		else if($bycat =='bysubshoper')
		{
			
			if($catid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $catid)
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		
		
		
		else
		{
			
			if($subid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $subid)
				->orderBy('id', 'DESC')->get(); 
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
					 $query->select('shopcats.id', 'shopcats.name');
					  }])
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		
		
		return response()->json($cats);
	
		 
	}
	
	
	
	
	
		
	public function indexjson($bycat ='' , $catid='')
	{
		$this->middleware('cors');
		if($bycat =='bycat')
		{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->withCount('subcats')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				
				->where('shopcats.catid', '=', null)
				->orderBy('id', 'DESC')->paginate(15); 

		}
		
		else if($bycat =='bysub')
		{	
			if($catid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $catid)
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->paginate(15); 

			}
			else
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->paginate(15);
			}
		}

		else
		{
			
			if($catid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $catid)
				->orderBy('id', 'DESC')->paginate(15); 
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->withCount('subcats')
				->with(['shopcat' => function($query){
					 $query->select('shopcats.id', 'shopcats.name');
					  }])
				->orderBy('id', 'DESC')->paginate(15);
			}
			
		}

		return response()->json([
                
                'cats' => $cats
            ]);
		 
	}
	
	
	public function indexjsonnav($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');
		if($bycat =='bycat')
		{
			$cats =Shopcat::withCount('shopers')
			->withCount('shoperrs')
			->with(['shopcat' => function($query){
			$query->select('shopcats.id', 'shopcats.name');
			}])	
			->where('shopcats.catid', '=', null)
			->orderBy('id', 'DESC')->get();

		}
		
		else if($bycat =='bysub')
		{
			
			if($subid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $subid)
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		else if($bycat =='bysubshoper')
		{
			
			if($catid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $catid)
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
		}
		
		
		
		else
		{
			
			if($subid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $subid)
				->orderBy('id', 'DESC')->get(); 
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
					 $query->select('shopcats.id', 'shopcats.name');
					  }])
				->orderBy('id', 'DESC')->get();
			}

		}
		return response()->json($cats);

		 
	}
	
	
	public function indexjsonnavpublic($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');
		if($bycat =='bycat')
		{
			$cats =Shopcat::withCount('shopers')
			->withCount('shoperrs')
			->with(['shopcat' => function($query){
			$query->select('shopcats.id', 'shopcats.name');
			}])	
			->where('shopcats.catid', '=', null)
			->orderBy('id', 'DESC')->get();

		}
		
		else if($bycat =='bysub')
		{
			
			if($subid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $subid)
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		else if($bycat =='bysubshoper')
		{
			
			if($catid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $catid)
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
		}
		
		
		
		else
		{
			
			if($subid != "")
			{
				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
				$query->select('shopcats.id', 'shopcats.name');
				}])
				->where('shopcats.catid', '=', $subid)
				->orderBy('id', 'DESC')->get(); 
			}
			else
			{

				$cats =Shopcat::withCount('shopers')
				->withCount('shoperrs')
				->with(['shopcat' => function($query){
					 $query->select('shopcats.id', 'shopcats.name');
					  }])
				->orderBy('id', 'DESC')->get();
			}

		}
		return response()->json($cats);

		 
	}
	
	
	
	
	
	
	

	public function catdropdown( )
	{
		$this->middleware('cors');
		

		$cats =Shopcat::where('catid', '=', NULL)->orderBy('id', 'DESC')->get();
		return response()->json($cats);
	}
	
	public function subdropdown($catid='')
	{
		
		$this->middleware('cors');
		if($catid != "" )
		{
			$subcats =Shopcat::where('catid', '!=', NULL)->where('catid', '=', $catid)->orderBy('id', 'DESC')->get(); 
		}
		else
		{
			$subcats =Shopcat::where('catid', '!=', NULL)->orderBy('id', 'DESC')->get();
		}
		return response()->json($subcats);
	}
	
	
	public function edit($id)
    {
        $this->middleware('cors');
        $cat = Shopcat::find($id);
        return response()->json($cat);
    }
	
	public function detail($id)
    {
        $this->middleware('cors');
        $cat = Shopcat::find($id);
        return response()->json($cat);
    }

	public function store(Request $request)
	{

        $cat = Shopcat::create($request->all());
        return response()->json(" Successfully added");

	}
	public function update(Request $request, $id)
    {
       
    	 $this->middleware('cors');
         $cat = Shopcat::find($id);
		 $cat->update($request->all());


        return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');

		$poters = "";
		try 
		{
			$cat = Shopcat::with('shopers')->find($id);
			//$cat = Shopcat::find($id);
			$cat->delete();
			
		} 
		catch (Exception $e) 
		{
			dd($e);
		}

        return response()->json( $poters . 'Successfully Deleted');
	}
	
	
	
	
	
}
