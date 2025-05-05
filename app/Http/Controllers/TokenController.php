<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TokenController extends Controller
{
    /**
     * Request access token.
     *
     * @response array{
     *   "access_token": "string",
     *  "token_type": "string",
     *  "expires_in": 3600,}
     */

    public function token(): JsonResponse
    {

        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => config('spotify.client_id'),
            'client_secret' => config('spotify.client_secret'),
        ]);

        if ($response->successful()) {
            return response()->json($response->json(), $response->status());
        } else {
            return response()->json([
                'error' => $response->json('error'),
                'error_description' => $response->json('error_description'),
            ], 400);
        }
    }
}
