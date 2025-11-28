<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté ET admin
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté.');
        }

        if (!auth()->user()->isAdmin()) {
            abort(403, 'Accès refusé. Cette page est réservée aux administrateurs.');
        }

        return $next($request);
    }
}