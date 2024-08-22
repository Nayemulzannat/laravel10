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
        $token = $request->header(key:'token');
        $result = JWTToken::veryfyToken($token);

        // Log the result for debugging
        // return $result;

        if (is_string($result) && $result === 'Unauthorized') {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Token verification unauthorized'
            ], 401);
        } elseif (is_object($result) && property_exists($result, 'userEmail')) {
            $request->headers->set('email', $result->userEmail);
            return $next($request);
        } else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Invalid token format'
            ], 400);
        }
    }
}
