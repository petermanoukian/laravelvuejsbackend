<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Redirect;
use App\About; 


class AboutController extends Controller
{
    public function _construct()
    {
        $this->middleware('cors');
    }
	public function indexjson($catid='')
	{
		$this->middleware('cors');
		$ab= About::orderBy('id', 'DESC')->paginate(5);
		return response()->json( $ab);
	}
	
	public function detail($id)
    {
        $this->middleware('cors');
        $abdetail = About::find($id);
        return response()->json($abdetail);
    }

	public function edit($id)
    {
        $this->middleware('cors');
        $ab = About::find($id);
        return response()->json($ab);
    }
	
	public function update(Request $request, $id)
    { 
    	$this->middleware('cors');
		$ab = About::find($id);
		if($request->post('image2'))
        {
          $img = $request->post('image2');
          $pic2 = time().'.' . explode('/', explode(':', substr($img, 0, strpos($img, ';')))[1])[1];
          \Image::make($request->post('image2'))->save(public_path('images/about/').$pic2)->resize(100, 100)->save(public_path('images/about/thumb/').$pic2);
        }
		else
		{
			$pic2 = $request->img;
		}
		$ab->img= $pic2;
		$ab->name = $request->name;
		$ab->description = $request->description;
		$ab->description2 = $request->description2;
		$ab->save();
        return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');
		About::destroy($id);
        return response()->json('Successfully Deleted');
	}

}
