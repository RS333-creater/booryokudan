<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'loginType' => 'required',
        'password' => 'required|string',
        'username' => 'nullable|string', // 個人ログイン用
        'company-id' => 'nullable|string', // 会社ログイン用
    ]);

    if ($request->loginType === 'personal') {
        $credentials = filter_var($request->username, FILTER_VALIDATE_EMAIL)
            ? ['email' => $request->username, 'password' => $request->password]
            : ['username' => $request->username, 'password' => $request->password];
    
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/mypage');
        }
    } else {
        $credentials = [
            'passport' => $request->input('company-id'), // パスポートを会社IDとして利用
            'password' => $request->password,
        ];
    }


    return back()->withErrors([
        'login' => 'The provided credentials do not match our records.',
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
