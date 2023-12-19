<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;

use App\Shoper; 
use App\Galleryshop; 

class GalleryshopController extends Controller
{
     public function _construct()
    {
        $this->middleware('cors');
    }
	
	
	public function indexjson($shopid='')
	{
		$this->middleware('cors');
		
		$gal = array();

		 if($shopid != "")
		 {
			 $gal= Galleryshop::with(['shoper' => function($query){
		     $query->select('shopers.id', 'shopers.name');
		      }])
			 ->where('galleryshops.shopid', '=', $shopid)->orderBy('galleryshops.id', 'DESC')->paginate(15);
		 }

		else
		{
             
			 $gal= Galleryshop::with(['shoper' => function($query){
		     $query->select('shopers.id', 'shopers.name');
		      }])->orderBy('galleryshops.id', 'DESC')->paginate(15);
		}
		return response()->json( $gal);

	}
	
	
	public function edit($id)
    {
        $this->middleware('cors');
        $shopimg = Galleryshop::with(['shoper'])->find($id);

		
        return response()->json($shopimg);
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
		  $shop = new Galleryshop();
		  $shop->logo= $pic;
		  $shop->name = $request->name;
		  $shop->shopid = $request->shopid;
		  $shop->save();   
        }
		else
		{
			$case .=  ' 87 is true no attach ';
			$pic = 'emptypic';
		}
		
		$imgr = "";
	
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
		  	$shop = Galleryshop::find($id);
			$shop->logo= $pic;
			$shop->name = $request->name;
			$shop->shopid = $request->shopid;

			$shop->save();
        }
		else
		{
			//$pic = $request->post('logo');
			$shop = Galleryshop::find($id);
			$shop->update($request->all());
		}
	
        return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');
		Galleryshop::destroy($id);
        return response()->json('Successfully Deleted');
	}
}
