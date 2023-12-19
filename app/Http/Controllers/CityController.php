<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use App\City; 
use App\Portfolio; 



class CityController extends Controller
{
    
	public function _construct()
    {
        $this->middleware('cors');
    }
	
	public function detail($id)
    {
        $this->middleware('cors');
        $citydetail = City::find($id);
        return response()->json($citydetail);
    }
	
	public function homejsondropdown()
	{
		$this->middleware('cors');
		$cities =City::withCount('portfolios')->orderBy('id', 'DESC')->get();
		return response()->json($cities);
	}
		
	public function indexjson()
	{
		$this->middleware('cors');
		//$cats= Portcat::orderBy('id', 'DESC')->get();
		$cities =City::withCount('portfolios')->orderBy('id', 'DESC')->paginate(5);
        //return response()->json($response);
		//return response()->json($cats);
	
		return response()->json([
                
                'cities' => $cities
            ]);
	}

	
	public function indexjsondropdown()
	{
		$this->middleware('cors');
		//$cats= Portcat::orderBy('id', 'DESC')->get();
		$cities =City::orderBy('id', 'DESC')->get();
        //return response()->json($response);
		return response()->json($cities);
	/*
		return response()->json([
                'filer' => $filer,
                'meta' => $meta
            ]);
			*/
	}
	public function edit($id)
    {
        $this->middleware('cors');
        $city = City::find($id);
        return response()->json($city);
    }

	public function store(Request $request)
	{
		/*
		$department = new Department([
          'department_name' => $request->get('department_name'),
          'department_code' => $request->get('department_code')
        ]);
        $department>save();
		*/
        $city = City::create($request->all());
        return response()->json(" Successfully added");

	}
	public function update(Request $request, $id)
    {
       
    	 $this->middleware('cors');
         $city = City::find($id);
		 $city->update($request->all());
        //$department->department_name = $request->get('department_name');
       // $department->department_code = $request->get('department_code');
        //$department->save();

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
			$city = City::with('portfolios')->find($id);
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
			$city->delete();
			
		} 
		catch (Exception $e) 
		{
			dd($e);
		}

		//Portcat::destroy($id);
        return response()->json( $poters . 'Successfully Deleted');
	}
	

}
