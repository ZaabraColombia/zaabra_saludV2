<?php
namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FormularioComposer{

    public function compose(view $view){
        $user=Auth::id();
        $tiempoRestante = DB::table('pagos')
        ->select(DB::raw('TIMESTAMPDIFF(DAY, pagos.fecha, fechaFin) AS dias_transcurrido, idtipopago'))
        ->where('pagos.idUsuario', '=',$user)
        ->first();
        $view->with('objTiempoRestante',$tiempoRestante);
    }
    
}
?>

