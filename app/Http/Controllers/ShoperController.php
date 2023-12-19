<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Redirect;
use App\Shopcat; 
use App\Shoper; 


class ShoperController extends Controller
{
     public function _construct()
    {
        $this->middleware(['cors', 'auth']);
		
    }
		
	public function indexjson($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');

		$shopcat = array();
		if($bycat =='bycat')
		{
			 if($catid != "")
			 {
				 $shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						
						 ->where('shopers.catid', '=', $catid)->orderBy('shopers.id', 'DESC')->paginate(10);
			 }

			else
			{
				 
				 $shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
					
						 ->orderBy('shopers.id', 'DESC')->paginate(10);
			}
		}
		else if($bycat =='bysub')
		{
			if($subid != "")
			{
				
				if($catid != "")
			    {
					$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						
						 ->where('shopers.catid', '=', $catid)
						 ->where('shoper.subid', '=', $subid)
						 ->orderBy('shopers.id', 'DESC')->paginate(10);
				}
				else
				{
					$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						$query->select('shopcats.id', 'shopcats.name');
						}])
						->with(['shopsub' => function($query){
						$query->select('shopcats.id', 'shopcats.name');
						}])
				
						->where('shoper.subid', '=', $subid)
						->orderBy('shopers.id', 'DESC')->paginate(10);
					
				}
			}

			else
			{
				if($catid != "")
			    {
					$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
					
						 ->where('shopers.catid', '=', $catid)->orderBy('shopers.id', 'DESC')->paginate(10);
			    } 
				
				else
				{
					$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						
						 ->orderBy('shopers.id', 'DESC')->paginate(10);
				}
			}
		}
		else
		{
			$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
			        $query->select('shopcats.id', 'shopcats.name');
			        }])
					->with(['shopsub' => function($query){
					$query->select('shopcats.id', 'shopcats.name');
					}])
				
					->orderBy('shopers.id', 'DESC')->paginate(10);
			
		}
		return response()->json( $shoper);

	}
	
	
	public function indexjsonpublic($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');

		$shopcat = array();
		if($bycat =='bycat')
		{
			 if($catid != "")
			 {
				 $shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						
						 ->where('shopers.catid', '=', $catid)->orderBy('shopers.id', 'DESC')->paginate(9);
			 }

			else
			{
				 
				 $shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
					
						 ->orderBy('shopers.id', 'DESC')->paginate(9);
			}
		}
		else if($bycat =='bysub')
		{
			if($subid != "")
			{
				
				if($catid != "")
			    {
					$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						
						 ->where('shopers.catid', '=', $catid)
						 ->where('shopers.subid', '=', $subid)
						 ->orderBy('shopers.id', 'DESC')->paginate(9);
				}
				else
				{
					$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						$query->select('shopcats.id', 'shopcats.name');
						}])
						->with(['shopsub' => function($query){
						$query->select('shopcats.id', 'shopcats.name');
						}])
				
						->where('shopers.subid', '=', $subid)
						->orderBy('shopers.id', 'DESC')->paginate(9);
					
				}
			}

			else
			{
				if($catid != "")
			    {
					$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
					
						 ->where('shopers.catid', '=', $catid)->orderBy('shopers.id', 'DESC')->paginate(9);
			    } 
				
				else
				{
					$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						
						 ->orderBy('shopers.id', 'DESC')->paginate(9);
				}
			}
		}
		else
		{
			$shoper= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
			        $query->select('shopcats.id', 'shopcats.name');
			        }])
					->with(['shopsub' => function($query){
					$query->select('shopcats.id', 'shopcats.name');
					}])
				
					->orderBy('shopers.id', 'DESC')->paginate(9);
			
		}
		return response()->json( $shoper);

	}
	
	
	public function search(Request $request)
	{
		$request1 = '%' . $request->keywords . '%';
		$shoper= Shoper::with(['shopcat' => function($query){
		$query->select('shopcats.id', 'shopcats.name');
		}])
		->with(['shopsub' => function($query){
		$query->select('shopcats.id', 'shopcats.name');
		}])
		->where('shopers.name', 'like', $request1 )
		->orwhere('shopers.description', 'like', $request1 )
		->orderBy('shopers.id', 'DESC')->paginate(9);
			
		
		return response()->json( $shoper);
		
		
	}
	
	
	
	
	
	
	public function indexjsondropdown()
	{
		$this->middleware('cors');
		
		$shops =Shoper::orderBy('id', 'DESC')->get(['id','name']);
        //return response()->json($response);
		return response()->json($shops);
	}
	
	
	
	public function indexjsonhome($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');

		$shopcat = array();
		if($bycat =='bycat')
		{
			 if($catid != "")
			 {
				$shops= Shoper::withCount('shopimages')->with(['shopcat' => function($query)
				{
					$query->select('shopcats.id', 'shopcats.name');
					}])
					->with(['shopsub' => function($query){
					$query->select('shopcats.id', 'shopcats.name');
					}])
					
					->where('shopers.catid', '=', $catid)->orderBy('shopers.id', 'DESC')->limit(3)->get();
				}

			else
			{
				 
				 $shops= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						 
						 ->orderBy('shopers.id', 'DESC')->limit(3)->get();
			}
		}
		else if($bycat =='bysub')
		{
			if($subid != "")
			{
				
				if($catid != "")
			    {
					$shops= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						  }])
						 
						 ->where('shopers.catid', '=', $catid)
						 ->where('shopers.subid', '=', $subid)
						 ->orderBy('shopers.id', 'DESC')->limit(3)->get();
				}
				else
				{
					$shops= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						$query->select('shopcats.id', 'shopcats.name');
						}])
						->with(['shopsub' => function($query){
						$query->select('shopcats.id', 'shopcats.name');
						}])
					
						->where('shops.subid', '=', $subid)
						->orderBy('shops.id', 'DESC')->limit(3)->get();
					
				}
			}

			else
			{
				if($catid != "")
			    {
					$shops= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						 $query->select('shopcats.id', 'shopcats.name');
						}])
						->with(['shopsub' => function($query){
						$query->select('shopcats.id', 'shopcats.name');
						}]) 
						->where('shopers.catid', '=', $catid)->orderBy('shopers.id', 'DESC')->limit(3)->get();
			    } 
				
				else
				{
					$shops= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						  ->with(['shopsub' => function($query){
						  $query->select('shopcats.id', 'shopcats.name');
						  }])
						
						 ->orderBy('shopers.id', 'DESC')->limit(3)->get();
				}
			}
		}
		else
		{
			$shops= Shoper::withCount('shopimages')->with(['shopcat' => function($query){
			        $query->select('shopcats.id', 'shopcats.name');
			        }])
					->with(['shopsub' => function($query){
					$query->select('shopcats.id', 'shopcats.name');
					}])
					
					->orderBy('shopers.id', 'DESC')->limit(3)->get();
			
		}
		return response()->json( $shops);

	}
	
	public function detailpublic($shopid)
    {
        // dd($galid);
	    $this->middleware('cors');
		//$portdetail = Portfolio::with(['portcat'])->find($id);
		//->first();
        $shopdetail = Shoper::with('shopimages')->
					with(['shopcat' => function($query){
					$query->select('shopcats.id', 'shopcats.name');
					}]) 
					->with(['shopsub' => function($query){
					$query->select('shopcats.id', 'shopcats.name');
					}])
					->where('shopers.id', '=', $shopid)->first();
        return response()->json($shopdetail);
    }

	public function edit($id)
    {
        $this->middleware('cors');
        $shop = Shoper::with(['shopcat'])->find($id);
        return response()->json($shop);
    }
	public function detailAdmin($id)
    {
        $this->middleware('cors');
        $shopdetail = Shoper::with(['shopcat'])->find($id);
        return response()->json($shopdetail);
    }

	
	public function store(Request $request)
	{

	    if($request->post('logo'))
       {
          $image = $request->get('logo');
          $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          // \Image::make($request->get('logo'))->save(public_path('images/').$pic)->resize(100, 100)->save(public_path('images/thumb/').$pic);
		  \Image::make($request->get('logo'))->save(public_path('images/shop/').$pic)->resize(310, 240)->save(public_path('images/shop/thumb/').$pic);
        }
		else
		{
			
			$pic = '';
		}
		/*$port = Portfolio::create($request->all());*/
		
		//$currentuserid = Auth::user()->id;
		//$currentuserid = Auth::user()->id;
		
		$shop = new Shoper();
		$shop->logo= $pic;
		
		$shop->name = $request->name;
		$shop->catid = $request->catid;
		$shop->subid = $request->subid;
		$shop->prix = $request->prix;
		$shop->description = $request->description;

		$shop->save();
		return response()->json(" Successfully added");

	}
	public function update(Request $request, $id)
    {
       
    	$this->middleware('cors');
		$shop = Shoper::find($id);
	
	
		if($request->post('image'))
		{
			$image = $request->post('image');
			$pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
			\Image::make($request->post('image'))->save(public_path('images/shop/').$pic)->resize(310, 240)->save(public_path('images/shop/thumb/').$pic);
			
			$shop->logo= $pic;
			$shop->name = $request->name;
			$shop->catid = $request->catid;
			$shop->subid = $request->subid;
			$shop->prix = $request->prix;
			$shop->description = $request->description;

			$shop->save();
		}
		else
		{
			$shop->name = $request->name;
			$shop->catid = $request->catid;
			$shop->subid = $request->subid;
			$shop->prix = $request->prix;
			$shop->description = $request->description;

			$shop->save();
		}
		return response()->json(" ok " );

    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');
		Shoper::destroy($id);
        return response()->json('Successfully Deleted');
	}
}
