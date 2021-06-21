<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class HeaderComposer{


    public function compose(view $view){
        $user=Auth::id()

        $tipoUsuario = DB::table('users')
        ->select(DB::raw('users.id,users_roles.idrol'))
        ->join('users_roles', 'users.id', '=', 'users_roles.iduser')
        ->where('users.id', '=',$user)
        ->first();

        $view->with('objtipoUsuarioLogueado'=>$tipoUsuario);
    }

}
?>