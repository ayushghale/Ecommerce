<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = DB::table('Users')->where('role', 1)->get();

        return response()->json([
            'success' => true,
            'message' => 'Admin found',
            'data' => $admin
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
}
