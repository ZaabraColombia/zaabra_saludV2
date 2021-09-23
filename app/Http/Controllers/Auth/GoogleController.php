<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function redirectToGoogle(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('email', '=' ,$user->email)->first();

            //dd($user->email);

            if($finduser){

                if (empty($finduser->google_id) or $user->id != $finduser->google_id)
                {
                    $finduser->google_id = $user->id;
                    $finduser->save();
                }

                Auth::login($finduser);

                return redirect()->intended('/');
            }else{
                return redirect()->route('login')->withErrors('email', __('auth.Es requerido registrarse primero'));
            }

        } catch (Exception $e) {
            dd($e);
        }
    }
}
