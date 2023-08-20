<?php

namespace App\Http\Controllers;

use App\Models\AllUser;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function rolefetch(Request $request){
        $email = $request->input('email');
        $user_role = AllUser::where('email',$email)->first();
        

        return response()->json($user_role);
    }
}
