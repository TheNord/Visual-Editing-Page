<?php

namespace App\Http\Middleware;

use App\Entity\Project\Settings;
use Closure;

class AvailableRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $access = Settings::where('name', 'registration_access')->first()->value;

        if (!$access) {
            return redirect('home')->with('error', 'Registration is not available at the moment');
        }

        return $next($request);
    }
}
