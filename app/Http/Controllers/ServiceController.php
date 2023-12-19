<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
 
use App\Service; 


class ServiceController extends Controller
{
    public function _construct()
    {
        $this->middleware('cors');
    }
	
	public function bannerslide()
	{
		$this->middleware('cors');
		$bannerslides =Service::orderBy('id', 'DESC')->get();
		return response()->json($bannerslides);
	}
	
	
	
		
	public function indexjson($catid='')
	{
		$this->middleware('cors');
		$serv= Service::orderBy('services.id', 'DESC')->paginate(5);
		return response()->json( $serv);
	}
	
	public function indexjsondropdown()
	{
		$this->middleware('cors');
		
		$services =Service::orderBy('id', 'DESC')->get(['id','name']);
        //return response()->json($response);
		return response()->json($services);
	}
	
	public function detail($id)
    {
        $this->middleware('cors');
        $servicedetail = Service::find($id);
        return response()->json($servicedetail);
    }

	public function edit($id)
    {
        $this->middleware('cors');
        $service = Service::find($id);
        return response()->json($service);
    }

	
	public function store(Request $request)
	{

	    if($request->post('icon'))
       {
          $imagel = $request->get('icon');
          $icon = time().'.' . explode('/', explode(':', substr($imagel, 0, strpos($imagel, ';')))[1])[1];
          // \Image::make($request->get('logo'))->save(public_path('images/').$pic)->resize(100, 100)->save(public_path('images/thumb/').$pic);
		  \Image::make($request->get('icon'))->save(public_path('images/service/icon/').$icon);
        }
		else
		{	
			$icon = '';
		}
		
		if($request->post('img'))
       {
          $image = $request->get('img');
          $img = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          // \Image::make($request->get('logo'))->save(public_path('images/').$pic)->resize(100, 100)->save(public_path('images/thumb/').$pic);
		  \Image::make($request->get('img'))->save(public_path('images/service/').$img)->resize(100, 100)->save(public_path('images/service/thumb/').$img);
        }
		else
		{	
			$img = '';
		}
		
		
		
		/*$port = Portfolio::create($request->all());*/
		
		$service = new Service();
        $service->icon= $icon;
		$service->img= $img;
		$service->name = $request->name;

		$service->des = $request->des;
		$service->des1 = $request->des1;
		$service->des2 = $request->des2;
		$service->save();
        return response()->json(" Successfully added");
	}
	public function update(Request $request, $id)
    {
       
    	$this->middleware('cors');
		$service = Service::find($id);
	    if($request->post('image'))
        {
          $image = $request->post('image');
          $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->post('image'))->save(public_path('images/service/icon/').$pic);
        }
		else
		{
			$pic = $request->icon;
		}
		if($request->post('image2'))
        {
          $img = $request->post('image2');
          $pic2 = time().'.' . explode('/', explode(':', substr($img, 0, strpos($img, ';')))[1])[1];
          \Image::make($request->post('image2'))->save(public_path('images/service/').$pic2)->resize(100, 100)->save(public_path('images/service/thumb/').$pic2);
        }
		else
		{
			$pic2 = $request->img;
		}
		
		$service->icon= $pic;
		$service->img= $pic2;
		$service->name = $request->name;
		$service->des = $request->des;
		$service->des1 = $request->des1;
		$service->des2 = $request->des2;
		$service->save();

		
		

        return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');
		Service::destroy($id);
        return response()->json('Successfully Deleted');
	}
}
