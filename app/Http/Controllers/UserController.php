<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
	public function login(Request $request)
	{
        $user = $request->user();

        $roles = $user->roles()->select('id', 'name')->get();

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            // 'password_changed_at' => $user->password_changed_at,
            // 'password_change_required' => $this->isPasswordExpired($user),
            'roles' => $roles,
            'permissions' => $user->getAllPermissions()->pluck('name')
        ]);
    }
}