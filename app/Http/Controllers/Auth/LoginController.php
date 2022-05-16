<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use SEO;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        SEO::setTitle('Iniciar Sesión');
        SEO::setDescription('Inicie sesión en Zaabra Salud, con su usuario y contraseña. Si la ha olvidado puede recuperarla');
        SEO::setCanonical('https://zaabrasalud.co/login');

        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $roles = auth()->user()->roles;

        if ($roles->contains('idrol', 1))
        {
            return redirect()->route('paciente.panel');
        }
        elseif ($roles->contains('idrol', 2) or $roles->contains('idrol', 5))
        {
            return redirect()->route('profesional.panel');
        }
        elseif ($roles->contains('idrol', 3) or $roles->contains('idrol', 4))
        {
            return redirect()->route('institucion.panel');
        }

        return redirect('/home');
    }
}
