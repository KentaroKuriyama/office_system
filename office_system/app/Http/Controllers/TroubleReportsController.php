<?php

namespace App\Http\Controllers;

use App\Models\Trouble;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class TroubleReportsController extends Controller
{
    private $formItems = ['function', 'occurred_at', 'phenomenon', 'reproduction_steps'];

    private $validator = [
        'function' => 'required',
        'occurred_at' => 'required',
        'phenomenon' => 'required|string|between:20, 10000',
        'reproduction_steps' => 'required|string|between:20, 10000'
    ];

    /**
     * 入力画面へ移動する
     *
     * @return object
     */
    public function reportInput() :object
    {
        return view('trouble_reports.input');
    }

    /**
     * 入力画面でのフォーム値を確認画面へ渡す
     *
     * @param object $request
     * @return object
     */
    public function reportPost(Request $request) :object
    {
        $input = $request->only($this->formItems);

        $validator = Validator::make($input, $this->validator);

        if ($validator->fails()) {
            // actionでクラス名とアクションで可読性を高める
            return redirect()->action([TroubleReportsController::class, 'reportInput'])
                ->withInput()
                ->withErrors($validator);
        }

        // 第一引数をキーとしてセッション変数にフォームの入力値を保存
        $request->session()->put('trouble_input', $input);

        // 判定に問題が無ければ確認画面にリダリレクト
        return redirect()->action([TroubleReportsController::class, 'reportConfirm']);
    }

    /**
     * 確認画面へ遷移
     *
     * @param object $request
     * @return object
     */
    public function reportConfirm(Request $request) :object
    {
        // セッションから値を取り出す
        $input = $request->session()->get('trouble_input');

        // セッションに値が無ければフォームに戻す
        if (empty($input)) {
            return redirect()->action([TroubleReportsController::class, 'reportInput']);
        }

        return view('trouble_reports.confirm', ['input' => $input]);
    }

    public function reportSend(Request $request)
    {
        // セッションから値を取り出す
        $input = $request->session()->get('trouble_input');

        // 戻るボタンが押されたら入力値と共にフォームにへ戻る
        if ($request->has('back')) {
            return redirect()->action([TroubleReportsController::class, 'reportInput'])
                ->withInput($input);
        }
    }

    public function reportResult()
    {

    }
}
