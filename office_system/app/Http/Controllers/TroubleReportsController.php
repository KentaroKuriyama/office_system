<?php

namespace App\Http\Controllers;

use App\Models\Trouble;
use App\Models\User;
use App\Mail\troubleReport;
use App\Mail\troubleReportForAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Mail\Mailer;
use Validator;

class TroubleReportsController extends Controller
{
    private $formItems = ['function', 'occurred_at', 'phenomenon', 'reproduction_steps'];

    private $validator = [
        'function' => 'required|numeric',
        'occurred_at' => 'required|date|before_or_equal:now',
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
            return redirect()->action([TroubleReportsController::class, 'reportInput'])
                ->withInput()
                ->withErrors($validator);
        }

        $request->session()->put('trouble_input', $input);

        return redirect()->action([TroubleReportsController::class, 'reportConfirm']);
    }

    /**
     * 確認画面の表示
     *
     * @param object $request
     * @return object
     */
    public function reportConfirm(Request $request) :object
    {
        $input = $request->session()->get('trouble_input');

        if (empty($input)) {
            return redirect()->action([TroubleReportsController::class, 'reportInput']);
        }

        return view('trouble_reports.confirm', ['input' => $input]);
    }

    /**
     * 完了画面へ遷移
     *
     * @param object $request
     * @return object
     */
    public function reportSend(Request $request, Mailer $mailer) :object
    {
        $input = $request->session()->get('trouble_input');
        $user = User::find(Auth::user()->id);
        // 管理者を取得する
        $admins = User::where('role_id', 1)
                ->orwhere('role_id', 2)
                ->where('deleted_at', null)
                ->get();
        $request->session()->regenerateToken();

        // 戻るボタンが押されたら入力値と共にフォームにへ戻る
        if ($request->has('back')) {
            return redirect()->action([TroubleReportsController::class, 'reportInput'])
                ->withInput($input);
        }

        $trouble = new Trouble;
        $trouble->setTroubleReportFillable();
        $trouble->fill([
            'function' => $input['function'],
            'occurred_at' => $input['occurred_at'],
            'phenomenon' => $input['phenomenon'],
            'reproduction_steps' => $input['reproduction_steps'],
            'priority' => 3,
            'status' => 1,
            'register_type' => 1,
            'create_user' => $user->id,
            'created_at' => now(),
            'updated_at' => null
        ]);
        $trouble->save();

        if ($trouble->save()) {
            $mailer->to($user->email)->send(new troubleReport($input, $user));
            // 管理者全員にメールを送信する
            foreach ($admins as $admin) {
                $mailer->to($admin->email)->send(new troubleReportForAdmin($input));
            }
            return redirect()->action([TroubleReportsController::class, 'reportResult']);
        } else {
            return redirect()->action([TroubleReportsController::class, 'reportInput'])->with('error', 'メールの送信に失敗しました。もう一度やり直してください');
        }
    }

    public function reportResult(Request $request)
    {
        $input = $request->session()->get('trouble_input');

        if (empty($input)) {
            return redirect()->action([TroubleReportsController::class, 'reportInput']);
        }

        $request->session()->forget('trouble_input');
        return view('trouble_reports.result');
    }
}
