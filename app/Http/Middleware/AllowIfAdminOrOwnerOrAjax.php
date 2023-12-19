<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AllowIfAdminOrOwnerOrAjax
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
	
	public function handle(Request $request, Closure $next)
	{
		if (!$request->ajax()) 
		{
			//	$ownerid = $request->route('id'));
			if ($this->auth->check() )
			{
				if (  $this->auth->user()->membertype == 'admin' || $this->auth->user()->id == $ownerid   )
				{
					return $next($request);
				}

				return redirect()->to('/admin/index');
			}
			return redirect()->to('/admin/index');	
		}
	
		return $next($request);

	}
}


