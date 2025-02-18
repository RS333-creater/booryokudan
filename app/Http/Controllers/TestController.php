<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TestController extends Controller
{
    public function getTest()
{
    $Test = DB::table('users')->get()->toArray();
    return view("index")->with("Test", $Test);
}
public function getTestPage()
{
    return view('test'); // 'test.blade.php' を表示
}

}