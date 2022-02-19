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
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['code' => 400,'error' => $validator->messages()], 400);
        }

        //Request is valid, create new user
        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'code' => 201,
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
                'code' => 400,
                'error' => 'Data validation error.',
                'message' => $validator->messages(),
            ], 400);
        }

        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'code' => 400,
                	'error'=> 'Email or password incorrect',
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	    // return $credentials;
            return response()->json([
                'code' => 500,
                'error'=> 'Error internal server!',
                'message' => 'Could not create token.',
            ], 500);
        }

 		//Token created, return with success response and jwt token
        return response()->json([
            'code' => 200,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $headers = $request->header();
        $validToken = ['token' => ''];

        if(isset($headers['authorization'])) {
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
            return response()->json(['code' => 400,'error' => $validator->messages()], 400);
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
                'code' => 500,
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