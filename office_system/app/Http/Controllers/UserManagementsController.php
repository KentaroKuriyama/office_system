<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use DateTime;
use Illuminate\Validation\Rule;

class UserManagementsController extends Controller
{
    private $formItems = ['name', 'login_id', 'email', 'password', 'role_id'];

    private $validator = [
        'name' => 'required|string|max:50',
        'login_id' => 'required|string|max:50',
        'email' => 'required|string|email:filter|unique:users',
        'password' => 'required|string|between:8, 50|unique:users',
        'role_id' => 'required'
    ];

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

    public function userCreateInput()
    {
        $roles = Role::all();
        return view('admin.user.create.input', ['roles' => $roles]);
    }

    public function userCreateSend(Request $request)
    {
        $input = $request->only($this->formItems);
        $validator = Validator::make($input, $this->validator);

        if ($validator->fails()) {
            return redirect()->action([UserManagementsController::class, 'userCreateInput'])
                ->withInput()
                ->withErrors($validator);
        }

        $user = new User;
        $user->setUserManagementFillable();
        $user->fill([
            'name' => $input['name'],
            'login_id' => $input['login_id'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => $input['role_id'],
            'created_at' => now(),
            'updated_at' => null
        ]);
        $user->save();

        if ($user->save()) {
            $request->session()->put('user_input', $input);
            return redirect()->action([UserManagementsController::class, 'userCreateResult']);
        } else {
            return redirect()->action([UserManagementsController::class, 'userCreateInput'])
                ->with('error', 'ユーザの登録に失敗しました。もう一度やり直してください');
        }
    }

    public function userCreateResult(Request $request)
    {
        $input = $request->session()->get('user_input');

        if (empty($input)) {
            return redirect()->action([UserManagementsController::class, 'userIndex'])
                ->with('error', '不正な遷移です');
        }

        $request->session()->forget('user_input');
        return view('admin.user.create.result');
    }

    public function userEditInput($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        if (empty($user)) {
            return redirect()->action([UserManagementsController::class, 'userIndex'])
                ->with('error', 'ユーザが見つかりませんでした。');
        }

        return view('admin.user.edit.input', ['user' => $user, 'roles' => $roles]);
    }

    public function userEditSend(Request $request, $id)
    {
        $input = $request->only($this->formItems);
        $user = User::find($id);
        // 動的にルートパラメータを取得
        $userId = $request->route('user');

        $validator = Validator::make($input, [
            'name' => 'required|string|max:50',
            'login_id' => 'required|string|max:50',
            'email' => [
                'required',
                'string',
                'email:filter',
                Rule::unique('users')->ignore($id, 'id'),
            ],
            'password' => 'required|string|between:8, 50|unique:users',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->action([UserManagementsController::class, 'userEditInput'], ['id' => $user->id])
                ->withInput()
                ->withErrors($validator);
        }

        $user->setUserManagementFillable();
        $user->fill([
            'name' => $input['name'],
            'login_id' => $input['login_id'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => $input['role_id'],
            'created_at' => null,
            'updated_at' => now()
        ]);
        $user->save();

        if ($user->save()) {
            $request->session()->put('user_input', $input);
            return redirect()->action([UserManagementsController::class, 'userEditResult']);
        } else {
            return redirect()->action([UserManagementsController::class, 'userEditInput'])
                ->with('error', 'ユーザの編集に失敗しました。もう一度やり直してください');
        }
    }

    public function userEditResult(Request $request, $id)
    {
        $input = $request->session()->get('user_input');
        $user = User::find($id);

        if (empty($input)) {
            return redirect()->action([UserManagementsController::class, 'userIndex'])
                ->with('error', '不正な遷移です');
        }

        $request->session()->forget('user_input');
        return view('admin.user.edit.result', ['id' => $user->id]);
    }

    public function userDelete()
    {
    }
}
