<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SigninController extends Controller
{
    public function signin()
    {
        $data = [
            'title' => 'Signin ' . env('APP_NAME')
        ];
        return view('authentication.signin', $data);
    }
}
