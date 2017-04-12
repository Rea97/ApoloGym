<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    //Migrar lógica de login a LoginController
    public function login(Request $request)
    {
        //Validación de los datos
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'min:6'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //Se intenta realizar el inicio de sesión
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            //Redireccionamos al dashboard de administrador
            return redirect()->intended(route('dashboard.start'));
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }
}
