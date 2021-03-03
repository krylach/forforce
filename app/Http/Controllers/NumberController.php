<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients\Number;
use Illuminate\Support\Facades\Validator;

class NumberController extends Controller
{
    public function topUpBalance(Number $number, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric|between:0.01,100.01'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $number->balance = $number->balance + (float)$request->value;
        $number->save();

        return $number;
    }
}
