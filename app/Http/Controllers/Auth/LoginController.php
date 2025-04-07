<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect path after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin'; // التوجيه بعد تسجيل الدخول

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override authenticated method to redirect the user.
     */
    protected function authenticated(Request $request, $user)
    {
        // التوجيه إلى الصفحة التي حاول المستخدم الوصول إليها أو إلى الصفحة الافتراضية
        return redirect()->intended($this->redirectTo);
    }

    /**
     * Logout the user and invalidate the session.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');  // التوجيه إلى صفحة تسجيل الدخول بعد الخروج
    }
}
