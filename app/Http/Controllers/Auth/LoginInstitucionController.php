<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SEO;

class LoginInstitucionController extends Controller
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
    protected $redirectTo = '/institucion/profesional/calendario';

    protected function guard()
    {
        return Auth::guard('institucion');
    }

    public function username()
    {
        return 'correo';
    }

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

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('institucion')->attempt(
            [
                'correo'    => $input['correo'],
                'password'  => $input['password'],
                'estado'    => 1
            ]
        ))
        {
            redirect()->route('institucion.profesional.calendario.index');
        }
        return redirect()->route('institucion.profesional.login')
            ->withErrors('correo','Credenciales incorrectas, Por favor vuelva a ingresar las credenciales.');

    }
}
