<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Personal_access_tokens;

class UserTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get header data
        $token = $request->header('Authorization');
        // Check if the token is valid
        $valid = Personal_access_tokens::where('token', $token)->exists();

        // If the token is not valid, return an error response
        if (!$valid) {
            return response()->json([
                'success' => false,
                'message' => 'unauthorized access',
            ], 401);
        }


        // You can now use $token for further processing

        // Pass the request to the next middleware
        return $next($request);
    }
}
