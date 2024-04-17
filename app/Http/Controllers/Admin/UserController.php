<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function displayUser()
    {
        $userDatas = User::all()->where('role', 0);

        return view('admin.user.displayUser', compact('userDatas'));
    }

    public function addUser()
    {
        return view('admin.user.addUser');
    }

    public function editUser($id)
    {
        $editUser = User::find($id);
        return view('admin.user.editUser', compact('editUser'));
    }

    // add new user
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required || email || unique:users',
            'contact_number' => 'required || numeric || unique:users' ,
            'location' => 'required',
            'password' => 'required',
            'conform_password' => 'required || same:password',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = ($request->email);
        $user->contact_number = $request->contact_number;
        $user->location = $request->location;
        $user->password = bcrypt($request->password);
        $user->save();


        return redirect()->route('admin.user.display')
            ->with('success', 'User created successfully.');
    }
    // update user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required || email',
            'contact_number' => 'required || numeric' ,
            'location' => 'required',
        ]);


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = ($request->email);
        $user->contact_number = $request->contact_number;
        $user->location = $request->location;
        if($request->password){
            $request->validate([
                'password' => 'required',
                'conform_password' => 'required || same:password',
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('admin.user.display')
            ->with('success', 'User updated successfully.');

    }

    // delete user
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.user.display')
            ->with('success', 'User deleted successfully.');
    }


}
