<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        // Permite múltiples roles separados por '|'
        $roles = explode('|', $role);

        if (! in_array($request->user()->role, $roles)) {
            abort(403, 'Acceso no autorizado. Tu rol no tiene permiso para esta acción.');
        }

        return $next($request);
    }
}
