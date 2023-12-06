<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DateTime;

class UserManagementsController extends Controller
{
    public function userIndex()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.user.index', ['users' => $users]);
    }

    public function userDetail($id)
    {
        $user = User::find($id);

        $createdAt = $user->created_at != null ? new DateTime($user->created_at) : '';
        $updatedAt = $user->updated_at != null ? new DateTime($user->updated_at) : '';

        return view(
            'admin.user.detail',
            [
                'user' => $user,
                'createdAt' => $createdAt,
                'updatedAt' => $updatedAt
            ]
        );
    }
}
