<?php

namespace App\Http\Controllers;

use App\Models\Trouble;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Mail\Mailer;
use Validator;

class TroubleManagementsController extends Controller
{
    private $formItems = [
        'function',
        'occurred_at',
        'phenomenon',
        'reproduction_steps',
        'cause',
        'cause_type',
        'cause_process',
        'corresponding_user_id',
        'corresponding_limit',
        'priority',
        'remarks',
    ];

    private $validator = [
        'function' => 'required|numeric',
        'occurred_at' => 'required|date|before_or_equal:now',
        'phenomenon' => 'required|string|between:20, 10000',
        'reproduction_steps' => 'required|string|between:20, 10000',
        'cause' => 'nullable|string|between:20, 10000',
        'cause_type' => 'nullable|numeric',
        'cause_process' => 'nullable|numeric',
        'corresponding_user_id' => 'nullable|numeric',
        'corresponding_limit' => 'nullable|date',
        'priority' => 'required|numeric',
        'remarks' => 'nullable|string|between:20, 10000',
    ];

    public function troubleIndex(Request $request)
    {
        $request->session()->put('pass', 'ok');
        $troubles = Trouble::where('deleted_at', null)->sortable()->orderBy('id', 'desc')->paginate(20);

        return view('admin.trouble.index', ['troubles' => $troubles]);
    }

    public function troubleDelete($id)
    {
        $trouble = Trouble::find($id);
        if (!$trouble) {
            return redirect()->action([TroubleManagementsController::class, 'troubleIndex'])
            ->with('error', 'ユーザが見つかりませんでした。');
        }

        $trouble->delete();
        return redirect()->action([TroubleManagementsController::class, 'troubleIndex'])
        ->with('delete', 'ユーザの削除が完了しました。');
    }

    public function troubleDetail($id)
    {
        $trouble = Trouble::find($id);
        $createUser = User::find($trouble->create_user);
        $updateUser = User::find($trouble->update_user);

        return view('admin.trouble.detail',
        [
            'trouble' => $trouble,
            'createUser' => $createUser,
            'updateUser' => $updateUser
        ]);
    }

    public function troubleCreateInput(Request $request)
    {
        $pass = $request->session()->get('pass');
        $admins = User::where('role_id', 1)
        ->orwhere('role_id', 2)
        ->where('deleted_at', null)
        ->get();

        if (empty($pass)) {
            return redirect()->action([TroubleManagementsController::class, 'troubleIndex'])
            ->with('error', '障害報告は一覧の障害を登録するボタンからしてください');
        }

        return view('admin.trouble.create.input', ['admins' => $admins]);
    }

    public function troubleCreateSend(Request $request)
    {
        $input = $request->only($this->formItems);
        $validator = Validator::make($input, $this->validator);
        $request->session()->regenerateToken();

        if ($validator->fails()) {
            return redirect()->action([TroubleManagementsController::class, 'troubleCreateInput'])
                ->withInput()
                ->withErrors($validator);
        }

        $trouble = Trouble::create([
            'function' => $input['function'],
            'occurred_at' => $input['occurred_at'],
            'phenomenon' => $input['phenomenon'],
            'reproduction_steps' => $input['reproduction_steps'],
            'cause' => $input['cause'],
            'cause_type' => $input['cause_type'],
            'cause_process' => $input['cause_process'],
            'corresponding_limit' => $input['corresponding_limit'],
            'corresponding_limit' => $input['corresponding_limit'],
            'priority' => $input['priority'],
            'remarks' => $input['remarks'],
            'status' => 1,
            'register_type' => 2,
            'create_user' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => null
        ]);

        if ($trouble) {
            $request->session()->put('trouble_input', $input);
            $request->session()->forget('pass');
            return redirect()->action([TroubleManagementsController::class, 'troubleCreateResult']);
        } else {
            return redirect()->action([TroubleManagementsController::class, 'troubleCreateInput'])
                ->with('error', '障害の登録に失敗しました。もう一度やり直してください');
        }
    }

    public function troubleCreateResult(Request $request)
    {
        $input = $request->session()->get('trouble_input');

        if (empty($input)) {
            return redirect()->action([TroubleManagementsController::class, 'troubleIndex'])
                ->with('error', '不正な遷移です');
        }

        $request->session()->forget('trouble_input');
        return view('admin.trouble.create.result');
    }

    public function troubleEditInput($id)
    {
        $trouble = Trouble::find($id);
        $admins = User::where('role_id', 1)
        ->orwhere('role_id', 2)
        ->where('deleted_at', null)
        ->get();

        return view('admin.trouble.edit.input');
    }

    public function troubleEditsend(Request $request, $id)
    {

    }

    public function troubleEditResult(Request $request, $id)
    {

    }

}
