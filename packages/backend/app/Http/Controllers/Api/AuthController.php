<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use JWTAuth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('first_name', 'last_name', 'login', 'email', 'password');
        $validator = Validator::make($data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'login' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        //Request is valid, create new user
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'login' => $request->login,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Not created user',
                'message' => $th->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }


        //User created, return success response
        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Data validation error.',
                'message' => $validator->messages(),
            ], 400);
        }

        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Email or password incorrect',
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
            // return $credentials;
            return response()->json([
                'error' => 'Error internal server!',
                'message' => 'Could not create token.',
            ], 500);
        }

        // Recover logged in user
        $user = auth()->user();

        //Token created, return with success response and jwt token
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $headers = $request->header();
        $validToken = ['token' => ''];

        if (isset($headers['authorization'])) {
            $tokenHeader = $headers['authorization'];
            $tokenHeader = str_replace("Bearer ", "", $tokenHeader);
            $validToken = ['token' => $tokenHeader];
        }

        //valid credential
        $validator = Validator::make($validToken, [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        //Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'code' => 200,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function me(Request $request)
    {
        $user = JWTAuth::authenticate($request->token);
        // $user = auth('api')->user();
        return response()->json(['user' => $user]);
    }
}
