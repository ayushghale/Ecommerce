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
    public function userLogin(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required | email | exists:users,email',
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
            return response()->json([
                'success' => false,
                'message' => 'User not registered',
                'errors' => $validate->errors(),
            ], 422);
        }

        $user = User::where('email', '=', $request->email)->first();

        
        try {
            // dd($user);

            if (Hash::check($request->password, $user->password)) {

                

                $token = $user->createToken('authToken')->plainTextToken;

                dd($token);

                // return redirect()->to('dashboard');
                return response()->json([
                    'success' => true,
                    'message' => 'User dashboard loged in',
                    'session' => session()->get('userLogedIn')
                ]);
            } else {
                // return redirect()->back()->with('fail','Incorrect Password');
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter correct password',
                    'errors' => 'Incorrect Password',

                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User login registered',
                'error' => $e->getMessage(),
            ]);
        }


    }
}
