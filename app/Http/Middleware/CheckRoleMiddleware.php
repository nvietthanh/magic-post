<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roleCodes): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // Lấy danh sách vai trò của người dùng hiện tại
            $userRoles = Auth::user()->roles()->first()->role_code;

            // Kiểm tra xem vai trò của người dùng có trong danh sách cần kiểm tra hay không
            if (in_array($userRoles, $roleCodes)) {
                // Nếu có ít nhất một vai trò hợp lệ, cho phép tiếp tục request
                return $next($request);
            }
        }

        // Nếu không có vai trò nào hợp lệ, chuyển hướng hoặc xử lý logic khác tùy ý
        return abort(403);
    }
}
