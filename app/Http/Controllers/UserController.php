<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function newRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCode' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success' => $success], 201);
    }


    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ip' => 'required|numeric|min:10',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $idPhone = $request->input('ip');
        $password = bcrypt($request->input('password'));

        $user = User::where('phone', $idPhone)->orWhere('idCode', $idPhone)->first();
        if ($user == null) {
            $responseArray['response'] = false;
            $responseArray['message'] = "User not found";
            return json_encode($responseArray);
        }

        $dbPassword = $user->password;
        if ($dbPassword != $password) {
            $responseArray['response'] = false;
            $responseArray['message'] = "Invalid password";
            $responseArray['Password'] = $dbPassword;
            $responseArray['password'] = $password;
            return json_encode($responseArray);
        }

        $responseArray['response'] = true;
        $responseArray['user'] = $user;
        $responseArray['token'] = $user->createToken('Access Token')->accessToken;
        return json_encode($responseArray);
    }


    public function getUserDetails(Request $request)
    {
        $isLogedIn = auth()->check();

        if ($isLogedIn) {
            $user = auth()->user();
            $responseArray['response'] = true;
            $responseArray['user'] = $user;
        } else {
            $responseArray['response'] = false;
            $responseArray['message'] = "Unauthorized user";
        }
        return json_encode($responseArray);
    }
}
