<?php

namespace App\Http\Middleware;

use App\Models\users_roles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id_user = auth()->user()->id;
        $ruta = $request->route()->getName();

        $rol = explode('.', $ruta);
        //No tiene nombre la ruta
        if (empty($rol[0]))
        {
            return redirect('/');
        }

        //asigno el id del rol
        switch ($rol[0]) {
            case 'paciente':
                $id_rol = 1;
                break;
            case 'profesional':
                $id_rol = 2;
                break;
            case 'entidad':
            case 'institucion':
                $id_rol = 3;
                break;
            case 'auxiliar':
                $id_rol = 4;
                break;
            default:
                $id_rol = 0;
                break;
        }

        //$permiso = DB::select('select users.id from users inner join users_roles on users_roles.id = users.id where users_roles.iduser = ' . $id_user . ' and users_roles.iduser = ' . $id_rol)->get();
        $permiso = users_roles::select('id')
            ->where('iduser', '=', $id_user)
            ->where('idrol', '=', $id_rol)
            ->first();

        //Si no existe el rol
        if (empty($permiso)) {
            return redirect('/');
        }

        //Si el proceso está correcto
        return $next($request);
    }
}
