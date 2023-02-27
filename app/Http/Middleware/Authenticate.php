<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use http\Client\Response;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        if ($request->is('api/*')) {
            return abort(response()->json(
                [
                    'api_status' => '401',
                    'message' => 'UnAuthenticated',
                ], 401));
        } else {
            return $request->expectsJson() ? null : route('login');
        }

    }
}
