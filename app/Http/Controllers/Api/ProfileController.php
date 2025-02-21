<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
   

    public function show($id)
{
    $user = User::find($id);
    
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json([
        'name'  => $user->name,
        'email' => $user->email
    ], 200);
}


}
