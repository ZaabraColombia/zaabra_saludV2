<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon ;
use App\Models\User;
use App\Models\users_roles;
use App\Models\pagos;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use SEO;

class RegisterController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        SEO::setTitle('Registro');
        SEO::setDescription('Regístrese en Zaabra Salud y acceda a los mejores servicios con especialistas e instituciones');
        SEO::setCanonical('https://zaabrasalud.co/register');

        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data){
        //dd($data);
        return Validator::make($data, [
            'idrol'             => ['required', Rule::in([1, 2, 3])],
            'primernombre'      => ['required_if:idrol,1,2', 'max:50'],
            'segundonombre'     => ['nullable', 'max:50'],
            'primerapellido'    => ['required_if:idrol,1,2', 'max:50'],
            'segundoapellido'   => ['nullable', 'max:50'],
            'nombreinstitucion' => ['required_if:idrol,3', 'max:50'],
            'tipodocumento'     => ['required', 'exists:tipo_documentos,id'],
            //'numerodocumento'   => ['required', 'max:50', 'unique:users,numerodocumento'],
            'numerodocumento'   => ['required', 'max:50'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'          => ['required', 'string', 'min:8', 'confirmed', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
            ],
            'aceptoTerminos' => ['required', 'accepted']
        ], [
            'idrol.in' => 'Escoger uno de los tres roles (Paciente, Doctor, Institución)',
            'primernombre.required_if' => 'El campo :attribute es obligatorio',
            'segundonombre.required_if' => 'El campo :attribute es obligatorio',
            'primerapellido.required_if' => 'El campo :attribute es obligatorio',
            'nombreinstitucion.required_if' => 'El campo :attribute es obligatorio',
        ], [
            'primernombre'      => 'Primer nombre',
            'segundonombre'     => 'Segundo nombre',
            'primerapellido'    => 'Primer apellido',
            'segundoapellido'   => 'Segundo apellido',
            'nombreinstitucion'   => 'Nombre institución',
            'tipodocumento'     => 'Tipo Documento',
            'numerodocumento'   => 'Número Documento',
            'email'     => 'Correo electrónico',
            'password'  => 'Contraseña',
            'aceptoTerminos'    => 'Términos y condiciones'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data){


        $user = User::create([
            'primernombre'      => $data['primernombre'],
            'segundonombre'     => $data['segundonombre'],
            'primerapellido'    => $data['primerapellido'],
            'segundoapellido'   => $data['segundoapellido'],
            'nombreinstitucion' => $data['nombreinstitucion'],
            'tipodocumento'     => $data['tipodocumento'],
            'numerodocumento'   => $data['numerodocumento'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'aceptoTerminos'    => $data['aceptoTerminos'],
        ]);


        $id_user=$user->id;

         users_roles::create([
            'iduser' =>  $id_user,
            'idrol' => $data['idrol'],
        ]);


        $id_rol=$data['idrol'];
        $fechaActual = Carbon::now();
        $fecha_fin_actual= Carbon::now();
        $fecha_fin = $fecha_fin_actual->addDays(8);

        if($id_rol <> 1){
            pagos::create([
                'fecha'=> $fechaActual,
                'fechaFin'=> $fecha_fin,
                'idUsuario' =>  $id_user,
                'idtipopago' => 14,
                'valor'=> 0,
                'aprobado'=>1,
            ]);
        }


        return $user;
    }


    public function showRegistrationForm()
    {
        $tipo_documentos = TipoDocumento::all();
        return view('auth.register', compact('tipo_documentos'));
    }


}
