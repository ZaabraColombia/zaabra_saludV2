<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function redirectToFB()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     */
    public function handleCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('social_id', $user->id)->first();

            if($finduser){

                if (empty($finduser->facebook_id) or $user->id != $finduser->facebook_id)
                {
                    $finduser->facebook_id = $user->id;
                    $finduser->save();
                }

                Auth::login($finduser);

                return redirect()->intended('/');
            }else{
                return redirect()->route('login')->withErrors('email', __('auth.Es requerido registrarse primero'));
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
