<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;

use App\Service; 
use App\Servicesub; 


class ServicesubController extends Controller
{
     public function _construct()
    {
        $this->middleware('cors');
    }
	
	
	public function indexjson($servid='')
	{
		$this->middleware('cors');

		$gal = array();

		 if($servid != "" && $servid != "0" && $servid != NULL)
		 {
			 $gal= Servicesub::with(['service' => function($query){
		     $query->select('services.id', 'services.name');
		      }])
			 ->where('servicesubs.servid', '=', $servid)->orderBy('servicesubs.id', 'DESC')->paginate(5);
		 }

		else
		{
             
			 $gal= Servicesub::with(['service' => function($query){
		     $query->select('services.id', 'services.name');
		      }])->orderBy('servicesubs.id', 'DESC')->paginate(5);
		}
		return response()->json( $gal);

	}
	
	
	public function edit($id)
    {
        $this->middleware('cors');
        $srvsub = Servicesub::with(['service'])->find($id);

		
        return response()->json($srvsub);
    }
	
	
	public function store(Request $request)
	{

		$pic = '';
	   if($request->post('logo'))
       {
		  $image = $request->post('logo'); 
		  $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
		  \Image::make($request->post('logo'))->save(public_path('images/gallerysub/').$pic)->resize(100, 100)->save(public_path('images/gallerysub/thumb/').$pic);
		   //$pic = 'picrimg';
		  $srvsub = new Servicesub();
		  $srvsub->logo= $pic;
		  $srvsub->name = $request->name;
		  $srvsub->servid = $request->servid;
		  $srvsub->save();   
        }
		else
		{
			$pic = 'emptypic';
		}
		$imgr = "";

        return response()->json(" Successfully added " );

	}
	public function update(Request $request, $id)
    {
       
    	$this->middleware('cors');
		 
	    if($request->post('image'))
        {
          $image = $request->post('image');
          $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->post('image'))->save(public_path('images/gallerysub/').$pic)->resize(100, 100)->save(public_path('images/gallerysub/thumb/').$pic);
		  	$srvsub = Servicesub::find($id);
			$srvsub->logo= $pic;
			$srvsub->name = $request->name;
			$srvsub->servid = $request->servid;

			$srvsub->save();
        }
		else
		{
			$srvsub = Servicesub::find($id);
			$srvsub->update($request->all());
		}



        return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');
		Servicesub::destroy($id);
        return response()->json('Successfully Deleted');
	}
}
