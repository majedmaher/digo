<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['is_admin'] = 0;
        $user = User::create($input);
        $success['token'] = $user->createToken('DigitalOnGo')->accessToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'User registered Successfully!');
    }



    public function login(Request $request)
    {


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('DigitalOnGo')->accessToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'User login successfully');
        } else {
            return $this->sendError('Please check your Auth', ['error' => 'Unauthorised']);
        }
    }
}
