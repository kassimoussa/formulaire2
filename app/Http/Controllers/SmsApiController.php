<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsApiController extends Controller
{

    public function coucou()
    {
        return "coucou";
    }
    public function sendSms(Request $request)
    {
        $this->validate($request, [
            'to' => 'required',
            'from' => 'required',
            'text' => 'required',
        ]);

        $url = 'http://10.39.230.68:13013/cgi-bin/sendsms';
        $user = 'sms_usr1';
        $pass = 'sms_pwd1';
        //$from = 'IOG';

        $response = Http::get($url, [
            'user' => $user,
            'pass' => $pass,
            'from' => $request->input('from'),
            'to' => '253'.$request->input('to'),
            'text' => $request->input('text'),
        ]);

        return response()->json([
            'status' => $response->status(),
            /* 'body' => $response, */
        ]);
    }
}
