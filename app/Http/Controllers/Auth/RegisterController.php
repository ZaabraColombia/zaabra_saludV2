<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\users_roles;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;


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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'primernombre' => ['required', 'string', 'max:25'],
            'primerapellido' => ['required', 'string', 'max:25'],
            'tipodocumento' => ['required', 'string', 'max:10'],
            'numerodocumento' => ['required', 'numeric', 'max:9923372036854775807'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'primernombre' => $data['primernombre'],
            'segundonombre' => $data['segundonombre'],
            'primerapellido' => $data['primerapellido'],
            'segundoapellido' => $data['segundoapellido'],
            'nombreinstitucion' => $data['nombreinstitucion'],
            'tipodocumento' => $data['tipodocumento'],
            'numerodocumento' => $data['numerodocumento'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        $id_user=$user->id;
        
         users_roles::create([
            'iduser' =>  $id_user,
            'idrol' => $data['idrol'],
        ]);

        return $user;
    }


}
