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
    public function troubleIndex()
    {
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

    public function troubleCreateInput()
    {

    }

    public function troubleCreateSend()
    {

    }

    public function troubleCreateResult()
    {

    }

    public function troubleEditInput()
    {

    }

    public function troubleEditsend()
    {

    }

    public function troubleEditResult()
    {

    }

}
