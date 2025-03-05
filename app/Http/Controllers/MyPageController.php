<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function calendar() {
        return view('calendar');
    }

    public function booking() {
        return view('booking');
    }

    public function spending() {
        return view('spending');
    }

    public function messages() {
        return view('messages');
    }
}
