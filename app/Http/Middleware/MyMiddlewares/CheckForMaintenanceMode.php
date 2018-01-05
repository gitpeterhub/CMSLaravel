<?php

namespace App\Http\Middleware\MyMiddlewares;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class CheckForMaintenanceMode
{
    /**
     * The application implementation.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance()) {
            $cookie = $request->cookie('secret-cookie');

            if ($cookie == null) {
               return response()->make(view('errors.503'), 503);
            }

            // Laravel cookies are encrypted
            $value = \Illuminate\Support\Facades\Crypt::decrypt($cookie);

            if($value != 'peter') {
                return response('Be right back!', 503);
            }
        }

        return $next($request);
    }
}