<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AllowIfAdminOrOwner
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       
	   
	    if ($this->auth->check() )
        {
            $ownerid = $request->route('id'));
			if (  $this->auth->user()->membertype == 'admin' || $this->auth->user()->id == $ownerid   )
            {
                return $next($request);
            }
			return redirect()->to('/admin/dashboard2/');
        }
        return redirect()->to('/admin/');
    }
}
