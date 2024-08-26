<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class tokenVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->cookie('token');
        $result = JWTToken::veryfyToken($token);

        if ($result == 'Unauthorized') {
            return redirect(to: '/userLogin');
        } else {
            $request->headers->set('userEmail', $result->userEmail);
            $request->headers->set('userID', $result->userID);
            return $next($request);
        }
    }
}
