<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use App\Blogcat; 
use App\Blog;
class BlogcatController extends Controller
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
			$cats =Blogcat::with(['subcats'])

			->where('blogcats.catid', '=', null)
			->orderBy('id', 'DESC')->get();

		}
		
		else if($bycat =='bysub')
		{
			
			if($subid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $subid)
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		else if($bycat =='bysubblog')
		{
			
			if($catid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $catid)
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		
		
		
		else
		{
			
			if($subid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $subid)
				->orderBy('id', 'DESC')->get(); 
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
					 $query->select('blogcats.id', 'blogcats.name');
					  }])
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		//$cats =Blogcat::orderBy('id', 'DESC')->paginate(5);
		
		return response()->json($cats);
		/*
		return response()->json([
                
                'cats' => $cats
            ]);
		*/
		 
	}
	
	
	
	
	
		
	public function indexjson($bycat ='' , $catid='')
	{
		$this->middleware('cors');
		if($bycat =='bycat')
		{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->withCount('subcats')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				
				->where('blogcats.catid', '=', null)
				->orderBy('id', 'DESC')->paginate(15); 

		}
		
		else if($bycat =='bysub')
		{	
			if($catid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $catid)
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->paginate(15); 

			}
			else
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->paginate(15);
			}
		}

		else
		{
			
			if($catid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $catid)
				->orderBy('id', 'DESC')->paginate(15); 
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->withCount('subcats')
				->with(['blogcat' => function($query){
					 $query->select('blogcats.id', 'blogcats.name');
					  }])
				->orderBy('id', 'DESC')->paginate(15);
			}
			
			
		}
		//$cats =Blogcat::orderBy('id', 'DESC')->paginate(5);
		
		return response()->json([
                
                'cats' => $cats
            ]);
		 
	}
	
	
	public function indexjsonnavpublic($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');
		if($bycat =='bycat')
		{
			$cats =Blogcat::withCount('blogs')
			->withCount('bloggs')
			->with(['blogcat' => function($query){
			$query->select('blogcats.id', 'blogcats.name');
			}])	
			->where('blogcats.catid', '=', null)
			->orderBy('id', 'DESC')->get();

		}
		
		else if($bycat =='bysub')
		{
			
			if($subid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $subid)
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		else if($bycat =='bysubblog')
		{
			
			if($catid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $catid)
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		
		
		
		else
		{
			
			if($subid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $subid)
				->orderBy('id', 'DESC')->get(); 
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
					 $query->select('blogcats.id', 'blogcats.name');
					  }])
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		//$cats =Blogcat::orderBy('id', 'DESC')->paginate(5);
		
		return response()->json($cats);
		/*
		return response()->json([
                
                'cats' => $cats
            ]);
		*/
		 
	}
	
	
	
	
	public function indexjsonnav($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');
		if($bycat =='bycat')
		{
			$cats =Blogcat::withCount('blogs')
			->withCount('bloggs')
			->with(['blogcat' => function($query){
			$query->select('blogcats.id', 'blogcats.name');
			}])	
			->where('blogcats.catid', '=', null)
			->orderBy('id', 'DESC')->get();

		}
		
		else if($bycat =='bysub')
		{
			
			if($subid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $subid)
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		else if($bycat =='bysubblog')
		{
			
			if($catid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $catid)
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '!=', null)
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		
		
		
		else
		{
			
			if($subid != "")
			{
				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
				$query->select('blogcats.id', 'blogcats.name');
				}])
				->where('blogcats.catid', '=', $subid)
				->orderBy('id', 'DESC')->get(); 
			}
			else
			{

				$cats =Blogcat::withCount('blogs')
				->withCount('bloggs')
				->with(['blogcat' => function($query){
					 $query->select('blogcats.id', 'blogcats.name');
					  }])
				->orderBy('id', 'DESC')->get();
			}
			
			
		}
		//$cats =Blogcat::orderBy('id', 'DESC')->paginate(5);
		
		return response()->json($cats);
		/*
		return response()->json([
                
                'cats' => $cats
            ]);
		*/
		 
	}
	
	
	

	public function catdropdown( )
	{
		$this->middleware('cors');
		
		/*
		if($bycat=='bycat')
		{
			$cats =Blogcat::where('catid', '=', NULL)->orderBy('id', 'DESC')->get();
		}
		*/
		/*
		else if($bycat=='bysub')
		{
			if($catid != "" )
			{
				$cats =Blogcat::where('catid', '!=', NULL)->where('catid', '=', $catid)->orderBy('id', 'DESC')->get(); 
			}
			else
			{
				$cats =Blogcat::where('catid', '!=', NULL)->orderBy('id', 'DESC')->get();
			}
			
		}
		*/
		$cats =Blogcat::where('catid', '=', NULL)->orderBy('id', 'DESC')->get();
		return response()->json($cats);
	}
	
	public function subdropdown($catid='')
	{
		
		$this->middleware('cors');
		if($catid != "" )
		{
			$subcats =Blogcat::where('catid', '!=', NULL)->where('catid', '=', $catid)->orderBy('id', 'DESC')->get(); 
		}
		else
		{
			$subcats =Blogcat::where('catid', '!=', NULL)->orderBy('id', 'DESC')->get();
		}
		return response()->json($subcats);
	}
	
	
	public function edit($id)
    {
        $this->middleware('cors');
        $cat = Blogcat::find($id);
        return response()->json($cat);
    }
	
	public function detail($id)
    {
        $this->middleware('cors');
        $cat = Blogcat::find($id);
        return response()->json($cat);
    }

	public function store(Request $request)
	{

        $cat = Blogcat::create($request->all());
        return response()->json(" Successfully added");

	}
	public function update(Request $request, $id)
    {
       
    	 $this->middleware('cors');
         $cat = Blogcat::find($id);
		 $cat->update($request->all());


        return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');

		$poters = "";
		try 
		{
			$cat = Blogcat::with('blogs')->find($id);
			//$cat = Blogcat::find($id);
			$cat->delete();
			
		} 
		catch (Exception $e) 
		{
			dd($e);
		}

        return response()->json( $poters . 'Successfully Deleted');
	}
}
