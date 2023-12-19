<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AllowIfAjaxOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   	protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    } 
	 
	 
	public function handle(Request $request, Closure $next)
	{
		if (!$request->ajax()) 
		{
			//return redirect()->to('/admin/');
			if ($this->auth->check() )
			{
				if ($this->auth->user()->membertype == 'admin')
				{
					return $next($request);
				}
				else if ($this->auth->user()->membertype == 'user')
				{
					return redirect()->to('/admin/dashboard2/');
				}
				return redirect()->to('/admin/dashboard2/');
			}
			else
			{
				return redirect()->to('/admin/index');	
			}
		}
	
		return $next($request);

	}
}
