<?php
// app/Http/Controllers/YourController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YourController extends Controller
{
    public function showMypage()
    {
        $user = Auth::user(); // ログインしているユーザー情報を取得

        // マイページのビューを返す
        return view('mypage', compact('user'));
    }
}
