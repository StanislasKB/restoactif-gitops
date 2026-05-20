<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class ProfilRequiredMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            return redirect(route('login'));
        }
        $user = Auth::user();
        if ($user->profil()==null) {
            return redirect(route('dashboard.profil.view')); // Redirige vers la page de profil
        }

        return $next($request);
    }
}
