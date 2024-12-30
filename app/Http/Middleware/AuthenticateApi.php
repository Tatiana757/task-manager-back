<?php

namespace App\Http\Middleware;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateApi extends Middleware
{
    protected function unauthenticated($request, array $guards = ['api'])
    {
        throw new HttpResponseException(
            response()->json([
                'error' => [
                    'message' => 'Unauthorized'
                ]
            ], 401)
        );
    }
}