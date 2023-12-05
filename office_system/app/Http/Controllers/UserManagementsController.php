<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserManagementsController extends Controller
{
    public function userIndex()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.user.index', ['users' => $users]);
    }
}
