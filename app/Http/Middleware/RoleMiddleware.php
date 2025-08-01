<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();
        $userRole = $user->role->name;
        
        // Support multiple roles separated by comma
        $allowedRoles = [];
        foreach ($roles as $role) {
            if (strpos($role, ',') !== false) {
                $allowedRoles = array_merge($allowedRoles, explode(',', $role));
            } else {
                $allowedRoles[] = $role;
            }
        }
        
        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Unauthorized - Role tidak memiliki akses ke halaman ini');
        }
        
        return $next($request);
    }
}
