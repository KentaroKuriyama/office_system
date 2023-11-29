<?php

namespace App\Http\Controllers;

use App\Models\Trouble;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class TroubleReportsController extends Controller
{
    private $foamItems = ['function', 'occurred_at', 'phenomenon', 'reproduction_steps'];

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

    public function reportPost()
    {

    }

    public function reportConfirm()
    {

    }

    public function reportSend()
    {

    }

    public function reportResult()
    {

    }
}
