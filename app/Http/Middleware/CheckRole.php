<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user || !$user->role) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        if (!in_array($user->role->name, $roles)) {
            return response()->json([
                'error' => 'No autorizado. Se requiere uno de estos roles: ' . implode(', ', $roles),
            ], 403);
        }

        return $next($request);
    }
}