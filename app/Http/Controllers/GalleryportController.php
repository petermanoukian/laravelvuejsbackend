<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;

use App\Portfolio; 
use App\Galleryport; 



class GalleryportController extends Controller
{
    public function _construct()
    {
        $this->middleware('cors');
    }
	
	
	public function indexjson($portid='')
	{
		$this->middleware('cors');
		//$cats= Portcat::orderBy('id', 'DESC')->get();
		
		//$cats =Portfolio::orderBy('id', 'DESC')->paginate(5);
        //return response()->json($response);
		//return response()->json($cats);
		$gal = array();

		 if($portid != "")
		 {
			 $gal= Galleryport::with(['portfolio' => function($query){
		     $query->select('portfolios.id', 'portfolios.name');
		      }])
			 ->where('galleryports.portid', '=', $portid)->orderBy('galleryports.id', 'DESC')->paginate(15);
		 }

		else
		{
             
			 $gal= Galleryport::with(['portfolio' => function($query){
		     $query->select('portfolios.id', 'portfolios.name');
		      }])->orderBy('galleryports.id', 'DESC')->paginate(15);
		}
		return response()->json( $gal);

	}
	
	
	public function edit($id)
    {
        $this->middleware('cors');
        $portimg = Galleryport::with(['portfolio'])->find($id);

		
        return response()->json($portimg);
    }
	
	
	public function store(Request $request)
	{

		$pic = '';
		$case = 'case';

	   if($request->post('logo'))
       {
          $case .=  ' 66 is true';
		  $image = $request->post('logo'); 
		  $case .=  ' 72 is true ' ;
		  $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
		  \Image::make($request->post('logo'))->save(public_path('images/gallery/').$pic)->resize(220, 220)->save(public_path('images/gallery/thumb/').$pic);
		   //$pic = 'picrimg';
		  $port = new Galleryport();
		  $port->logo= $pic;
		  $port->name = $request->name;
		  $port->portid = $request->portid;
		  $port->save();   
        }
		else
		{
			$case .=  ' 87 is true no attach ';
			$pic = 'emptypic';
		}
		/*$port = Portfolio::create($request->all());*/
		$imgr = "";
		/*
       	  foreach($request->post('attachments') as $attach)
		  {
		   $imgr . " Image  $attach ";
			// $image = $attach;
			 // $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
			 // \Image::make($request->get('logo'))->save(public_path('images/').$pic);
		  }
		  
		  */
        return response()->json(" Successfully added $imgr " . $case);

	}
	public function update(Request $request, $id)
    {
       
    	$this->middleware('cors');
		 
	    if($request->post('image'))
        {
          $image = $request->post('image');
          $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->post('image'))->save(public_path('images/gallery/').$pic)->resize(220, 220)->save(public_path('images/gallery/thumb/').$pic);
		  	$port = Galleryport::find($id);
			$port->logo= $pic;
			$port->name = $request->name;
			$port->portid = $request->portid;

			$port->save();
        }
		else
		{
			//$pic = $request->post('logo');
			$port = Galleryport::find($id);
			$port->update($request->all());
		}
		/*$port = Portfolio::create($request->all());*/
		

		 

        //$department->department_name = $request->get('department_name');
       // $department->department_code = $request->get('department_code');
        //$department->save();

        return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');
		Galleryport::destroy($id);
        return response()->json('Successfully Deleted');
	}
	
	
	
	
}
