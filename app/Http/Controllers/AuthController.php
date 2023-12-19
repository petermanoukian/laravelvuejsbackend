<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{

	/**
	* Create a new AuthController instance.
	*
	* @return void
	*/

	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login', 'register','refresh']]);
	}

	/**
	* Get a JWT via given credentials.
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	public function register(Request $request)
	{
		$this->validate($request, [
		'name' => 'required',
		'email' => 'required|email',
		'password' => 'required|min:6',
		'membertype' => 'required|in:admin,user',
		]);
		$user = new User();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->membertype = $request->membertype;
		$user->save();
		return response()->json(['user' => $user]);
	}

	/**
	* Get a JWT via given credentials.
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	public function login(Request $request)
	{
		$credentials = request(['email', 'password']);
		$email = $request->email;
		if (! $token = auth('api')->attempt($credentials)) 
		{
			return response()->json(['error' => 'Unauthorized'], 401);
		}
		else
		{
			$user = User::where('email', "$email")->first();
			//dd($user);
			auth('web')->login($user);
			auth('api')->login($user);
			$token = auth()->login($user);
			return $this->respondWithToken($token);
		}
	}

	/**
	* Get the authenticated User.
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	public function me()
	{
		return response()->json(auth('api')->user());
	}

	/**
	* Log the user out (Invalidate the token).
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	public function logout()
	{
		auth('api')->logout();
		auth('web')->logout();
		auth()->logout();
		return redirect()->to('/admin/index');	
		//return response()->json(['message' => 'Successfully logged out']);
	}

	/**
	* Refresh a token.
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	public function refresh()
	{
		$current_token  = JWTAuth::getToken();
		$token = auth()->fromUser(auth()->user());
		$token1          = JWTAuth::refresh($current_token);
		
		$newToken = JWTAuth::parseToken()->refresh();
		//return $this->respondWithToken(auth('api')->refresh());
		return $this->respondWithToken($token);
	}

	/**
	* Get the token array structure.
	*
	* @param string $token
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	protected function respondWithToken($token)
	{
		
		return response()->json([
		'access_token' => $token,
		'user' => $this->guard()->user(),
		'token_type' => 'bearer',
		'expires_in' => auth('api')->factory()->getTTL() * 60
		]);
	}

	public function guard()
	{
		return \Auth::Guard('api');
	}
}