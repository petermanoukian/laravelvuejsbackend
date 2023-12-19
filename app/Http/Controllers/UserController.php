<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Redirect;
use App\User;

class UserController extends Controller
{
    public function _construct()
    {
        $this->middleware('cors');
    }
		
	public function indexjson($userid='')
	{
		$this->middleware('cors');
		
		
		if($userid != "")
		 {
			 $users = User::find($userid);
		 }

		else
		{
             $users =User::orderBy('id', 'DESC')->paginate(5);
		}
		
		
		
		return response()->json( $users);
	}
	
	
	public function indexjson2($userid='')
	{
		$this->middleware('cors');
		
		
		if($userid != "")
		 {
			 //$user = User::findorfail($userid);
			$user = User::find($userid);
		 }
		else
		{
             $user ='';
		}
		
		
		
		return response()->json( $user);
	}
	
	
	
	public function edit($id)
    {
        $this->middleware('cors,adminajaxowner');
        $user = User::find($id);
        return response()->json($user);
    }

	public function update(Request $request, $id)
    {
       
    	 $this->middleware('cors');
         $user = User::find($id);
		 
		 if($request->post('password') && $request->post('password') != '')
        {

			$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:6',
			'membertype' => 'required|in:admin,user',
			]);

			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = bcrypt($request->password);
			$user->membertype = $request->membertype;
			$user->save();

        }
		else
		{
			$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'membertype' => 'required|in:admin,user',
			]);
			
			$user->update($request->all());
		}
         return response()->json('Successfully Updated');
    }
	
	public function destroy($id)
	{
	    $this->middleware('cors,admin');

		try 
		{
			$user = User::find($id);
			$user->delete();	
		} 
		catch (Exception $e) 
		{
			dd($e);
		}
        return response()->json( 'Successfully Deleted');
	}

}
