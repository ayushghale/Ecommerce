<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display all users
     */
    public function userData()
    {
        $users = DB::table('users')->where('role', 0)->get();
        return response()->json($users);
    }

    /**
     * Display user by their id
     */
    public function showUserById(string $id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'location' => 'required',
            'contact_number' => 'required | min:10 | unique:users',
            'password' => 'required | same:conform_password',
            'conform_password' => 'required | same:password',
        ]);
        if ($validate->fails()) {
            // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
            return response()->json([
                'success' => false,
                'message' => 'User not registered',
                'errors' => $validate->errors(),
            ], 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->location = $request->location;
        $user->contact_number = $request->contact_number;
        $user->password = bcrypt($request->password);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('site/uploads/user/', $new_image);
            $save_url = '/site/uploads/user/' . $new_image;
            $user->image = $save_url;
        }
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => $user,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'contact_number' => [
                'required',
                'min:10',
                Rule::unique('users')->ignore($user->id), // Ignore the current user while checking uniqueness
            ],
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|same:conform_password',
            'conform_password' => 'required|same:password',
            'location' => 'required',
        ]);

        if ($validate->fails()) {
            // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
            return response()->json([
                'success' => false,
                'message' => 'User not updated',
                'errors' => $validate->errors(),
            ], 422);
        }

        // Update user information
        $user->name = $request->name;
        $user->contact_number = $request->contact_number;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->location = $request->location;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not deleted',
                'error' => $e->getMessage(),
            ], 500);
        }

    }
}
