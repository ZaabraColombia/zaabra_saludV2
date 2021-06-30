<?php
namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ListaPermisosComposer{
    
    public function compose(view $view){
        $user=Auth::id();
        $listaPermiso1 = DB::table('users')
        ->select(DB::raw('permisos.nombrePermiso,users.id,users_roles.idrol'))
        ->join('users_roles', 'users.id', '=', 'users_roles.iduser')
        ->join('roles', 'users_roles.idrol', '=', 'roles.id')
        ->join('permisos', 'roles.id', '=', 'permisos.idRoles')
        ->where('users.id', '=',$user)
        ->where('permisos.id_permiso_Padre', '=',1)
        ->get();

        $listaPermiso2 = DB::table('users')
        ->select(DB::raw('permisos.nombrePermiso,users.id,users_roles.idrol'))
        ->join('users_roles', 'users.id', '=', 'users_roles.iduser')
        ->join('roles', 'users_roles.idrol', '=', 'roles.id')
        ->join('permisos', 'roles.id', '=', 'permisos.idRoles')
        ->where('users.id', '=',$user)
        ->where('permisos.id_permiso_Padre', '=',2)
        ->get();

        $listaPermiso3 = DB::table('users')
        ->select(DB::raw('permisos.nombrePermiso,users.id,users_roles.idrol'))
        ->join('users_roles', 'users.id', '=', 'users_roles.iduser')
        ->join('roles', 'users_roles.idrol', '=', 'roles.id')
        ->join('permisos', 'roles.id', '=', 'permisos.idRoles')
        ->where('users.id', '=',$user)
        ->where('permisos.id_permiso_Padre', '=',3)
        ->get();

        $listaPermiso4 = DB::table('users')
        ->select(DB::raw('permisos.nombrePermiso,users.id,users_roles.idrol'))
        ->join('users_roles', 'users.id', '=', 'users_roles.iduser')
        ->join('roles', 'users_roles.idrol', '=', 'roles.id')
        ->join('permisos', 'roles.id', '=', 'permisos.idRoles')
        ->where('users.id', '=',$user)
        ->where('permisos.id_permiso_Padre', '=',4)
        ->get();

        $view->with('objListaUsuario1',$listaPermiso1)
             ->with('objListaUsuario2',$listaPermiso2)
             ->with('objListaUsuario3',$listaPermiso3)
             ->with('objListaUsuario4',$listaPermiso4);
    }
}
?>


