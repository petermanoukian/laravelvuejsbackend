<?php
namespace App\Http\Middleware;
use Closure;
//use App\Exceptions\UnauthorizedException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AllowIfAdmin
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
            if ($this->auth->user()->membertype == 'admin')
            {
                return $next($request);
            }
			return redirect()->to('/admin/dashboard2/');
        }
        return redirect()->to('/admin/');
    }
}
