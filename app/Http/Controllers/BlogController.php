<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use App\Blogcat; 
use App\Blog; 
use App\User;
use Auth;
class BlogController extends Controller
{
     public function _construct()
    {
        $this->middleware(['cors', 'auth']);
		
    }
	
	
	public function indexjsonpublic($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');

		$blogcat = array();
		if($bycat =='bycat')
		{
			 if($catid != "")
			 {
				 $bloger= Blog::with(['blogcat' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						  }])
						 ->where('blogs.catid', '=', $catid)->orderBy('blogs.id', 'DESC')->paginate(9);
			 }

			else
			{
				 
				 $bloger= Blog::with(['blogcat' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						 }])
						 ->orderBy('blogs.id', 'DESC')->paginate(9);
			}
		}
		else if($bycat =='bysub')
		{
			if($subid != "")
			{
				
				if($catid != "")
			    {
					$bloger= Blog::with(['blogcat' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						  }])
						 ->where('blogs.catid', '=', $catid)
						 ->where('blogs.subid', '=', $subid)
						 ->orderBy('blogs.id', 'DESC')->paginate(9);
				}
				else
				{
					$bloger= Blog::with(['blogcat' => function($query){
						$query->select('blogcats.id', 'blogcats.name');
						}])
						->with(['blogsub' => function($query){
						$query->select('blogcats.id', 'blogcats.name');
						}])
						->with(['user' => function($query){
						$query->select('users.id', 'users.name');
						}])
						->where('blogs.subid', '=', $subid)
						->orderBy('blogs.id', 'DESC')->paginate(9);
					
				}
			}

			else
			{
				if($catid != "")
			    {
					$bloger= Blog::with(['blogcat' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						  }])
						 ->where('blogs.catid', '=', $catid)->orderBy('blogs.id', 'DESC')->paginate(9);
			    } 
				
				else
				{
					$bloger= Blog::with(['blogcat' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						 }])
						 ->orderBy('blogs.id', 'DESC')->paginate(9);
				}
			}
		}
		else
		{
			$bloger= Blog::with(['blogcat' => function($query){
			        $query->select('blogcats.id', 'blogcats.name');
			        }])
					->with(['blogsub' => function($query){
					$query->select('blogcats.id', 'blogcats.name');
					}])
					->with(['user' => function($query){
					$query->select('users.id', 'users.name');
					}])
					->orderBy('blogs.id', 'DESC')->paginate(9);
			
		}
		return response()->json( $bloger);

	}
	
	
	public function search(Request $request)
	{
		$request1 = '%' . $request->keywords . '%';
		$bloger= Blog::with(['blogcat' => function($query){
		$query->select('blogcats.id', 'blogcats.name');
		}])
		->with(['blogsub' => function($query){
		$query->select('blogcats.id', 'blogcats.name');
		}])
		->where('blogs.name', 'like', $request1 )
		->orwhere('blogs.description', 'like', $request1 )
		->orderBy('blogs.id', 'DESC')->paginate(9);
			
		
		return response()->json( $bloger);
		
		
	}
	
	
		
	public function indexjson($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');

		$blogcat = array();
		if($bycat =='bycat')
		{
			 if($catid != "")
			 {
				 $bloger= Blog::with(['blogcat' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						  }])
						 ->where('blogs.catid', '=', $catid)->orderBy('blogs.id', 'DESC')->paginate(10);
			 }

			else
			{
				 
				 $bloger= Blog::with(['blogcat' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						 }])
						 ->orderBy('blogs.id', 'DESC')->paginate(10);
			}
		}
		else if($bycat =='bysub')
		{
			if($subid != "")
			{
				
				if($catid != "")
			    {
					$bloger= Blog::with(['blogcat' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						  }])
						 ->where('blogs.catid', '=', $catid)
						 ->where('blogs.subid', '=', $subid)
						 ->orderBy('blogs.id', 'DESC')->paginate(10);
				}
				else
				{
					$bloger= Blog::with(['blogcat' => function($query){
						$query->select('blogcats.id', 'blogcats.name');
						}])
						->with(['blogsub' => function($query){
						$query->select('blogcats.id', 'blogcats.name');
						}])
						->with(['user' => function($query){
						$query->select('users.id', 'users.name');
						}])
						->where('blogs.subid', '=', $subid)
						->orderBy('blogs.id', 'DESC')->paginate(10);
					
				}
			}

			else
			{
				if($catid != "")
			    {
					$bloger= Blog::with(['blogcat' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						  }])
						 ->where('blogs.catid', '=', $catid)->orderBy('blogs.id', 'DESC')->paginate(10);
			    } 
				
				else
				{
					$bloger= Blog::with(['blogcat' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						 }])
						 ->orderBy('blogs.id', 'DESC')->paginate(10);
				}
			}
		}
		else
		{
			$bloger= Blog::with(['blogcat' => function($query){
			        $query->select('blogcats.id', 'blogcats.name');
			        }])
					->with(['blogsub' => function($query){
					$query->select('blogcats.id', 'blogcats.name');
					}])
					->with(['user' => function($query){
					$query->select('users.id', 'users.name');
					}])
					->orderBy('blogs.id', 'DESC')->paginate(10);
			
		}
		return response()->json( $bloger);

	}
	
	
	public function indexjsonhome($bycat ='' , $catid='', $subid='')
	{
		$this->middleware('cors');

		$blogcat = array();
		if($bycat =='bycat')
		{
			 if($catid != "")
			 {
				$blogs= Blog::with(['blogcat' => function($query)
				{
					$query->select('blogcats.id', 'blogcats.name');
					}])
					->with(['blogsub' => function($query){
					$query->select('blogcats.id', 'blogcats.name');
					}])
					->with(['user' => function($query){
					$query->select('users.id', 'users.name');
					}])
					->where('blogs.catid', '=', $catid)->orderBy('blogs.id', 'DESC')->limit(6)->get();
				}

			else
			{
				 
				 $blogs= Blog::with(['blogcat' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						 }])
						 ->orderBy('blogs.id', 'DESC')->limit(6)->get();
			}
		}
		else if($bycat =='bysub')
		{
			if($subid != "")
			{
				
				if($catid != "")
			    {
					$blogs= Blog::with(['blogcat' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						  }])
						 ->where('blogs.catid', '=', $catid)
						 ->where('blogs.subid', '=', $subid)
						 ->orderBy('blogs.id', 'DESC')->limit(6)->get();
				}
				else
				{
					$blogs= Blog::with(['blogcat' => function($query){
						$query->select('blogcats.id', 'blogcats.name');
						}])
						->with(['blogsub' => function($query){
						$query->select('blogcats.id', 'blogcats.name');
						}])
						->with(['user' => function($query){
						$query->select('users.id', 'users.name');
						}])
						->where('blogs.subid', '=', $subid)
						->orderBy('blogs.id', 'DESC')->limit(6)->get();
					
				}
			}

			else
			{
				if($catid != "")
			    {
					$blogs= Blog::with(['blogcat' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						 $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						  }])
						 ->where('blogs.catid', '=', $catid)->orderBy('blogs.id', 'DESC')->limit(6)->get();
			    } 
				
				else
				{
					$blogs= Blog::with(['blogcat' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['blogsub' => function($query){
						  $query->select('blogcats.id', 'blogcats.name');
						  }])
						  ->with(['user' => function($query){
						 $query->select('users.id', 'users.name');
						 }])
						 ->orderBy('blogs.id', 'DESC')->limit(6)->get();
				}
			}
		}
		else
		{
			$blogs= Blog::with(['blogcat' => function($query){
			        $query->select('blogcats.id', 'blogcats.name');
			        }])
					->with(['blogsub' => function($query){
					$query->select('blogcats.id', 'blogcats.name');
					}])
					->with(['user' => function($query){
					$query->select('users.id', 'users.name');
					}])
					->orderBy('blogs.id', 'DESC')->limit(6)->get();
			
		}
		return response()->json( $blogs);

	}
	
	
	public function detailpublic($blogid)
    {
        // dd($galid);
	    $this->middleware('cors');
		//$portdetail = Portfolio::with(['portcat'])->find($id);
		//->first();
        $blogdetail = Blog::with(['blogcat' => function($query){
					$query->select('blogcats.id', 'blogcats.name');
					}]) 
					->with(['blogsub' => function($query){
					$query->select('blogcats.id', 'blogcats.name');
					}])
					->where('blogs.id', '=', $blogid)->first();
        return response()->json($blogdetail);
    }
	
	
	
	

	public function edit($id)
    {
        $this->middleware('cors');
        $blog = Blog::with(['blogcat'])->find($id);
        return response()->json($blog);
    }


	
	public function store(Request $request)
	{

	    if($request->post('logo'))
       {
          $image = $request->get('logo');
          $pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          // \Image::make($request->get('logo'))->save(public_path('images/').$pic)->resize(100, 100)->save(public_path('images/thumb/').$pic);
		  \Image::make($request->get('logo'))->save(public_path('images/blog/').$pic)->resize(240, 240)->save(public_path('images/blog/thumb/').$pic);
        }
		else
		{
			
			$pic = '';
		}
		/*$port = Portfolio::create($request->all());*/
		$user = Auth::user();

		//$currentuserid = Auth::user()->id;
		//$currentuserid = Auth::user()->id;
		
		$blog = new Blog();
		$blog->logo= $pic;
		$currentuserid = $request->userid;
		$blog->name = $request->name;
		$blog->catid = $request->catid;
		$blog->subid = $request->subid;
		$blog->userid = $currentuserid;
		$blog->description = $request->description;

		$blog->save();
		return response()->json(" Successfully added");

	}
	public function update(Request $request, $id)
    {
       
    	$this->middleware('cors');
		$blog = Blog::find($id);
		$bloguserid = $blog->userid;
		$currentuserid = $request->post('useridd');
		$currentuserlevel = $request->post('membertype');
		
		if($currentuserlevel == 'admin' || $currentuserid == $bloguserid)
		{
			if($request->post('image'))
			{
				$image = $request->post('image');
				$pic = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
				\Image::make($request->post('image'))->save(public_path('images/blog/').$pic)->resize(240, 240)->save(public_path('images/blog/thumb/').$pic);
				
				$blog->logo= $pic;
				$blog->name = $request->name;
				$blog->catid = $request->catid;
				$blog->subid = $request->subid;
				$blog->description = $request->description;

				$blog->save();
			}
			else
			{
				$blog->name = $request->name;
				$blog->catid = $request->catid;
				$blog->subid = $request->subid;
				$blog->description = $request->description;

				$blog->save();
			}
			return response()->json(" NAME  IT should update User level is $currentuserlevel and logger id : $currentuserid  --- IS  equal to blogposterid : $bloguserid" );
		}
		else
		{
			return response()->json(" NAME should NOT  update User level is $currentuserlevel and logger id : $currentuserid --- is NOT  equal to blogposterid  : $bloguserid" );
		}
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors');
		Blog::destroy($id);
        return response()->json('Successfully Deleted');
	}
}
