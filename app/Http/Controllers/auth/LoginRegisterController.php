<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $inputEmail = $request->email;
        $inputPassword = $request->password;
        try {
            $UserData = User::where('email', '=', $inputEmail)->first();

            if (!$UserData) {
                return response()->json([
                    'success' => false,
                    'message' => 'User No Account Found for this Email',
                ], 404);
            }

            if ($UserData->role === 1) {
                // dd('admin');
                if (Hash::check($request->password, $UserData->password)) {

                    $token = $UserData->createToken('authToken', $UserData->id);
                    // dd($token);

                    return response()->json([
                        'success' => true,
                        'message' => 'User dashboard loged in',
                        'data' => $UserData,
                        'token' => $token,
                        'session' => session()->get('adminLogedIn')
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'user incorrect password',
                    ], 401);
                }
            } elseif ($UserData->role === 0) {
                // dd('staff');
                if (Hash::check($request->password, $UserData->password)) {
                    $token = $UserData->createToken('authToken', $UserData->id);
                    return response()->json([
                        'success' => true,
                        'message' => 'User dashboard loged in',
                        'data' => $UserData,
                        'token' => $token,
                        'session' => session()->get('user')
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'user incorrect password',
                    ], 401);
                }
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'User No Account Found for this Email',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'user not login',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function Register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'contact_number' => 'required|min:10|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|same:conform_password',
            'conform_password' => 'required|same:password',
            'location' => 'required',
        ]);
        if ($validate->fails()) {
            // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->location = $request->location;
        $user->contact_number = $request->contact_number;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }


    public function logout(User $user, int $id)
    {
        if (!$user->find($id)) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ]);
        } else {
            // $user->deleteToken($id);
            $token = $user->deleteToken($id);
            if ($token) {
                return response()->json([
                    'success' => true,
                    'message' => 'User logout successfully',
                ]);
            }
            else {
                return response()->json([
                    'success' => false,
                    'message' => 'User not logout',
                ]);
            }
        }
    }

}
