<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleManager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authUserRole = Auth::user()->role;

        // تعريف صلاحيات الأدوار المسموحة
        $roles = [
            'admin' => 0,
            'vendor' => 1,
            'customer' => 2,
        ];

        // تعريف المسارات البديلة عند عدم السماح
        $redirectRoutes = [
            0 => 'admin',
            1 => 'vendor',
            2 => 'home',
        ];

        // السماح بالوصول إذا الدور مطابق
        if (isset($roles[$role]) && $authUserRole === $roles[$role]) {
            return $next($request);
        }

        // إعادة التوجيه بناءً على الدور الحالي للمستخدم
        return redirect()->route($redirectRoutes[$authUserRole] ?? 'login');
    }
}

