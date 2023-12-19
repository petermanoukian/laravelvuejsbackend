<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use App\Tag; 
use App\Portfoliotag;

class TagController extends Controller
{
    public function _construct()
    {
        $this->middleware('cors');
    }
	
		public function detail($id)
    {
        $this->middleware('cors');
        $tagdetail = Tag::find($id);
        return response()->json($tagdetail);
    }
		
	public function indexjson()
	{
		$this->middleware('cors');
		//$cats= Portcat::orderBy('id', 'DESC')->get();
		$tags =Tag::orderBy('id', 'DESC')->paginate(60);
        //return response()->json($response);
		//return response()->json($cats);
	
		return response()->json([
                
                'tags' => $tags
            ]);
	}

	
	public function indexjsondropdown()
	{
		$this->middleware('cors');
		//$cats= Portcat::orderBy('id', 'DESC')->get();
		$tags =Tag::orderBy('id', 'DESC')->get();
        //return response()->json($response);
		return response()->json($tags);
	}
	
	public function jsonTags( $galid='')
	{
		$this->middleware('cors');
		$galid = $galid;
		if($galid != '')
		{
			$tags= DB::table('tags')
			->select('tags.id as id', 'tags.name as name')
			->join('portfoliotags', 'portfoliotags.tagid', '=', 'tags.id')
			->join('portfolios', 'portfolios.id', '=', 'portfoliotags.portfolioid')
			->where('portfoliotags.portfolioid', '=', $galid)
			->get();
		}

		else
		{
             $tags =Tag::orderBy('id', 'DESC')->get();
		}
	
		return response()->json($tags);
	}
	
	
	
	
	public function jsondropdownEdit($typ='' , $port_id='')
	{
		$this->middleware('cors');
		$port_id = $port_id;
		 if($typ != "" && $port_id != '')
		 {
		    //dd($typ . $port_id );
		 	if($typ == 'selected')
			{
			     /*
				 $tags= Portfoliotag:: 
				 with(['tags' => function($query) use ($port_id) {
				 $query->select('tags.id', 'tags.name');
				  }]) ->where('portfolioid', '=', $port_id)
				 ->orderBy('id', 'DESC')->get();
				 */
				 
				$tags= DB::table('tags')
				->select('tags.id as id', 'tags.name as name')
				->join('portfoliotags', 'portfoliotags.tagid', '=', 'tags.id')
				->join('portfolios', 'portfolios.id', '=', 'portfoliotags.portfolioid')
				->where('portfoliotags.portfolioid', '=', $port_id)
				->get();
				 
			}
			else if($typ == 'nonseleted')
			{
				/*
				$tags= Portfoliotag:: 
				 with(['tags' => function($query) use ($port_id) {
				 $query->select('tags.id', 'tags.name');
				  }]) ->where('portfolioid', '=', $port_id)
				 ->orderBy('id', 'DESC')->get();
				 */
				$tg1 = '';
				$tags1= DB::table('portfoliotags')
				->select('portfoliotags.tagid as tgid')
				->where('portfoliotags.portfolioid', "=" , "$port_id")->get();
				$result = json_decode($tags1, true);
				foreach($result as $tgx)
				{
					 $tgid = $tgx['tgid'];
					 $tg1 .= "$tgid,";
				}
				$tg1 = substr_replace($tg1,'', strrpos($tg1, ','), 1);
				 //$tg1 .= ']';
				//dd($tg1);
				//$tags= DB::table('tags')
				$tks = Portfoliotag::where('portfolioid',$port_id)->get();
				foreach ($tks as $tk) 
				{
					$data[] = $tk->tagid;
				}
				
				
				if($tg1 != '')
				{
					
					$tags= Tag::
					select('tags.id as id', 'tags.name as name')
					//->select('tags.id as id', 'tags.name as name', 'portfolios.id as portfolioid' , 'portfolios.name as portname' ,'portfoliotags.tagid as tgid')
					//->whereNotIn('tags.id',  [$tg1])
					->whereNotIn('tags.id',  $data)
					//->join('portfoliotags', 'portfoliotags.tagid', '=', 'tags.id')
					//->join('portfolios', 'portfolios.id', '=', 'portfoliotags.portfolioid')
					//->where('portfoliotags.portfolioid', "!=" , "$port_id")
					//->whereNotIn('portfoliotags.tagid',  [$tg1])
					
					->get();
				}
				else
				{
					$tags= Tag::
					select('tags.id as id', 'tags.name as name')
					->get();
				}
			}
			 
		
		
		 }

		else
		{
             $tags =Tag::orderBy('id', 'DESC')->get();
		}
	
		return response()->json($tags);
	}
	
	
	public function jsondropdownArray($port_id='')
	{
		$this->middleware('cors');
		$port_id = $port_id;
		$tg=array();
		if($port_id != '')
		{

			$tags= DB::table('tags')
			->select('tags.id as id')
			->join('portfoliotags', 'portfoliotags.tagid', '=', 'tags.id')
			->join('portfolios', 'portfolios.id', '=', 'portfoliotags.portfolioid')
			->where('portfoliotags.portfolioid', '=', $port_id)
			->get();
			foreach($tags as $tag)
			{
				$tagid =  $tag->id;
				array_push($tg , $tagid);
			}
		}
			 

	
		return response()->json($tg);
	}
	
	
	
	
	
	public function edit($id)
    {
        $this->middleware('cors');
        $tag = Tag::find($id);
        return response()->json($tag);
    }

	public function store(Request $request)
	{
        $tag = Tag::create($request->all());
        return response()->json(" Successfully added");
	}
	public function update(Request $request, $id)
    {
       
    	 $this->middleware('cors');
         $tag = Tag::find($id);
		 $tag->update($request->all());


        return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');
		//$cat = Portcat::find($id);
		//$cat->portfolios()->delete();
		//$cat->delete();
		$poters = "";
		try 
		{
			$tag = Tag::find($id);
			//$ports = Portcat::find($id)->portfolios;
			/*
			if ($cat->has('portfolios')) 
			{
				$poters .= " it has portfolios $cat->name   ";
				foreach ($cat->portfolios as $portx) 
				{
					$poters .= " Portfolio  " ;
					$portx->delete();
					//$user->photos()->detach($photo);
				}
			}
			$cat->portfolios()->delete();
			*/
			//$ports->delete();
			$tag->delete();
			
		} 
		catch (Exception $e) 
		{
			dd($e);
		}

		//Portcat::destroy($id);
        return response()->json( $poters . 'Successfully Deleted');
	}
	
}
