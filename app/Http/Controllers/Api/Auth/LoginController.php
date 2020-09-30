<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $credentials =  $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $token = $this->createToken();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::createFromFormat('Y-m-d H:i:s', $token->token->expires_at)->toDateTimeString()
        ], 200);
    }

    private function createToken()
    {
        $token = Auth::user()->createToken(config('app.name'));
        $token->token->expires_at = Carbon::now()->addDay();
        $token->token->save();

        return $token;
    }
}
