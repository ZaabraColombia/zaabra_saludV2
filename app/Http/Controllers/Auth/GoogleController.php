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
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('email', '=' ,$user->getEmail())->orWhere('google_id', '=' ,$user->id)->first();

            if($finduser){

                if (empty($finduser->google_id) or $user->id != $finduser->google_id)
                {
                    $finduser->google_id = $user->id;
                    $finduser->save();
                }

                Auth::login($finduser);

                return redirect()->intended('home');

            }else{
//                $newUser = User::create([
//                    'name' => $user->name,
//                    'email' => $user->email,
//                    'google_id'=> $user->id,
//                    'password' => encrypt('123456dummy')
//                ]);
//
//                Auth::login($newUser);
//
//                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            dd($e);
        }
    }
}
