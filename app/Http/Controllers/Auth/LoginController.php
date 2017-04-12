<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/inicio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin,client,instructor', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /* TODO: migrar el inicio de sesión del controlador del admin, a este.
     public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }
     */

    /*public function login(Request $request)
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
        //dd(Auth::guard($request->guard)->attempt($credentials, $request->remember));
        //dd($request->guard);

        //Se intenta realizar el inicio de sesión
        if (Auth::guard($request->guard)->attempt($credentials, $request->remember)) {
            //Redireccionamos al dashboard de administrador
            //dd('Inició sesion');
            return redirect()->intended(route('dashboard.start'));
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }*/

    public function login(Request $request)
    {
        //Validación de credenciales de usuario
        $this->validateLogin($request);
        //Verificación de intentos de inicio de sesión
         if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        //Se hace el intento de iniciar sesión
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        //Si falla, se incrementa el total de intentos de sesión fallidos
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard($request->guard)->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    protected function guard($guard = null)
    {
        return Auth::guard($guard);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }
}
