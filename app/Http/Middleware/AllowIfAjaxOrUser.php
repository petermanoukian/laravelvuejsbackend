<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Concerns\InteractsWithInput;

use App\User;

use JWTAuth;

use Exception;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


class AllowIfAjaxOrUser extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   	protected $auth;
    //public function __construct(Guard $auth)
	public function __construct(Guard $auth)
    {
       //$this->middleware('auth:api');
	   $this->auth = $auth;
    } 
	 
	 
	public function handle($request, Closure $next)
	{
		$guard = Auth::getDefaultDriver();
		//$key = auth()->user()->getJWTIdentifier();
		
		if (!$request->ajax()) 
		{
			$r = $this->auth;
			//return redirect()->to('/admin/');
			//if ($this->auth->check() )
			//if ($this->auth->api->check() )
			//if (Auth::guard('api')->check() )
			/*
			if (Auth::guard('api')->check()
			)			
			{
				
				return $next($request);
			}
			else
			{
				
				//print_r($r);
				//dd($guard);
				return redirect()->to('/admin/index');	
			}
			*/
			
			// https://laracasts.com/index.php/discuss/channels/general-discussion/how-to-refreshing-jwt-token
			try {
                $user = JWTAuth::parseToken()->authenticate();
				//return $next($request);
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    return redirect()->to('/admin/index');	
                }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    
				try
                {
                  $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                  $user = JWTAuth::setToken($refreshed)->toUser();
                  $request->headers->set('Authorization','Bearer '.$refreshed);
                }catch (JWTException $e){
                    return response()->json([
                        'code'   => 103,
                        'message' => 'Token cannot be refreshed, please Login again'
                    ]);
                }	
					
					
					
					
                }else{
					
                    
					return redirect()->to('/admin/index');	
                }
            }
            return $next($request);
			
			
			
			
			
			
			
			
			
			
			
			
		}
	
		return $next($request);

	}
	
	/*
	public function authenticate($request, array $guards)
	{
		if (empty($guards)) 
		{
			$guards = [null];
		}
		foreach ($guards as $guard) 
		{
			if ($this->auth->guard($guard)->check()) 
			{
				return $this->auth->shouldUse($guard);
			}
		}
		return 'authentication_failed';
	}
	*/
	
}
