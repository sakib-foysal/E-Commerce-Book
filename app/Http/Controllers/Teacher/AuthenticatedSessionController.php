<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
{
return view('teacher.auth.login');
}

public function store(Request $request)
{
$request->validate([
'email' => ['required','email'],
'password' => ['required'],
]);
if (!Auth::guard('teacher')->attempt($request->only('email','password'), $request->boolean('remember'))) {
throw ValidationException::withMessages([
'email' => __('auth.failed'),
]);
}
$request->session()->regenerate();
return redirect()->intended(route('teacher.dashboard'));
}
public function destroy(Request $request)
{
Auth::guard('teacher')->logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
return redirect('/teacher/login');
}


}
