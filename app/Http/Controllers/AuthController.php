<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $form_data = [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => 'nAlun5wExxKhop4aUgBDJJgJu2rmnzZiYnFiqRpE',
            'username' => '5955612',
            'password' => 'secret'
        ];

        $user = User::where('personal_number', '5955612')->first();

        if ($user) {
            if (\Hash::check('secret', $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = 'Password mismatch';
                return response($response, 422);
            }
        } else {
            $response = 'User doesn\'t exist';
            return response($response, 422);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'personal_number' => 'required|numeric',
            'melli_code' => 'required|numeric',
            'birthdate' => 'required',
            'user_level' => 'required|in:2,3',
            'password' => 'required|min:6'
        ]);

        return User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'personal_number' => $request->personal_number,
            'melli_code' => $request->melli_code,
            'birthdate' => $request->birthdate,
            'user_level' => $request->user_level,
            'password' => $request->password
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully.');
    }
}
