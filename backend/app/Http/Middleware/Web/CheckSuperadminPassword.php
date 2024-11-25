<?php

namespace App\Http\Middleware\Web;

use App\Models\Base\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperadminPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $superadmin = User::where('email', 'superadmin@kemenhub.go.id')->first();

        if(isset($superadmin->password)){
            return $next($request);
        }else {
            return redirect('/duty-pro/wizard/lisensi-dan-persetujuan');
        }
    }
}
