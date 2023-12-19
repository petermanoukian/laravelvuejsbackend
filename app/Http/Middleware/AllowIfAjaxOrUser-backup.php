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


class AllowIfAjaxOrUser
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
	 
	 
	public function handle(Request $request, Closure $next, ...$guards)
	{
		$guard = Auth::getDefaultDriver();
		if (!$request->ajax()) 
		{
			$r = $this->auth;
			//return redirect()->to('/admin/');
			//if ($this->auth->check() )
			//if ($this->auth->api->check() )
			//if (Auth::guard('api')->check() )
			
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
			/*
			if ($this->authenticate($request, $guards) === 'authentication_failed') {
				return redirect()->to('/admin/index');
			}
			return $next($request);
			*/
			
			
			
		}
	
		return $next($request);

	}
	
	
	protected function authenticate($request, array $guards)
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
	
	
}
