<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use App\Models\tipoconsultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function view;

class CalendarioController extends Controller{
    public function index(Request $request){

        if (isset($request->id))
        {
            $profesional    = $this->profesional($request->id);
            $profesional    = $profesional[0];
            $consultas      = tipoconsultas::where('idperfil', '=', $request->id)->get();
            $calificacion   = $this->calificacion($request->id);

            if (!empty($profesional)) {
                return view('panelAdministrativoPac.calendario.asignar-cita', compact(
                    'profesional',
                    'consultas',
                    'calificacion'
                ));
            }else{
                return view('panelAdministrativoPac.calendario.asignar-cita', ['error' => 'El perfil no existe']);
            }
        }

        return view('panelAdministrativoPac.calendario.asignar-cita');
    }

    public function profesional($id){
        return DB::select("SELECT pf.idPerfilProfesional, pf.fotoperfil, CONCAT('Dr.(a) ',  us.primernombre) AS primernombre, us.segundonombre, us.primerapellido, us.segundoapellido, ep.nombreEspecialidad, pf.numeroTarjeta, pf.direccion, un.nombreuniversidad, pf.descripcionPerfil, mn.nombre
        FROM perfilesprofesionales pf
        INNER JOIN users us ON pf.idUser=us.id
        INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
        INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
        INNER JOIN universidades un ON pf.id_universidad=un.id_universidad
        INNER JOIN municipios mn ON mn.id_municipio=pf.id_municipio
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional = '$id' LIMIT 1");
    }
    // consulta comentarios
    public function calificacion($idPerfilProfesional){
        return DB::select("SELECT us.primernombre, us.primerapellido, c.comentario,c.calificacion,
        (SELECT (ROUND(SUM(c.calificacion) / COUNT(c.calificacion)))
        FROM comentarios c
        INNER JOIN perfilesprofesionales p ON c.idperfil=p.idPerfilProfesional
        WHERE p.idPerfilProfesional=$idPerfilProfesional) AS calificacionRedondeada
        FROM  users_roles ur
        LEFT JOIN users us  ON ur.iduser=us.id
        LEFT JOIN perfilesprofesionales pf  ON us.id=pf.idUser
        LEFT JOIN comentarios c ON ur.iduser=c.idusuariorol
        WHERE c.comentario<>'' AND c.idperfil=$idPerfilProfesional");
    }
}
