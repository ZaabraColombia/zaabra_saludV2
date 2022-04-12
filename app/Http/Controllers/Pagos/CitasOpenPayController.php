<?php

namespace App\Http\Controllers\Pagos;

use App\Http\Controllers\Controller;
use App\Models\HistorialPagoCita;
use App\Models\PagoCita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Openpay\Data\Openpay;
use Exception;
use Openpay\Data\OpenpayApi;

class CitasOpenPayController extends Controller
{

    public function __construct()
    {
        //parent::__construct();

    }

    public function detalle_profesional (Request $request) {
        $pagoCita = PagoCita::query()
            ->where('id', '=', $request->pago_cita)
            ->with([
                'cita',
                'cita.paciente',
                'cita.paciente.user',
                'cita.profesional',
                'cita.profesional.user',
                'cita.profesional.especialidad',
            ])
            ->first();

        if (empty($pagoCita)) abort(404);

        return view('pagos.detalles-pago', compact('pagoCita'));
    }

    /*public function store_profesional_two(Request $request)
    {
        try {
            $pagoCita = PagoCita::query()
                ->where('id', '=', $request->pago_cita)
                ->with([
                    'cita',
                    'cita.paciente',
                    'cita.paciente.user',
                    'cita.profesional',
                    'cita.profesional.user',
                ])
                ->first();

            if (isset($pagoCita) and $pagoCita->valor != null)
            {
                // create instance OpenPay
                $openpay = Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'), 'CO');

                Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));

                // create object customer
                $paciente = $pagoCita->cita->paciente;

                $customer = array(
                    'name'          => $paciente->user->nombres,
                    'last_name'     => $paciente->user->apellidos,
                    'email'         => $paciente->user->email,
                    'phone_number'  => $paciente->celular
                );

                $order_id = $paciente->user->id . time();

                $profesional = $pagoCita->cita->profesional;
                $cita = $pagoCita->cita;

                $chargeRequest =  array(
                    //'source_id'     => ,
                    "order_id"      => $order_id,
                    'amount'        => $pagoCita->valor,
                    'currency'      => 'COP',
                    'description'   => "Cita medica {$profesional->user->nombre_completo}"
                        . "{$cita->fecha_inicio->format('Y-m-d')} / "
                        . "{$cita->fecha_inicio->format('H:i A')} - {$cita->fecha_fin->format('H:i A')}"
                        . "{$cita->lugar}",
                    //'device_session_id' => $request->deviceSessionId,
                    'customer'      => $customer,
                    'redirect_url'  => route('profesional.respuesta-pago-cita')
                );

                switch ($request->metodo_pago)
                {
                    case 'pse':

                        $chargeRequest['iva'] = 0;

                        $charge = $openpay->pses->create($chargeRequest);
                        $order_res = $charge->orderid;
                        $url = $charge->redirect_url;

                        break;
                    default:

                        $chargeRequest['method']        = 'card';
                        $chargeRequest['send_email']    = true;
                        $chargeRequest['confirm']       = false;

                        $charge = $openpay->charges->create($chargeRequest);
                        $order_res = $charge->order_id;
                        $url = $charge->payment_method->url;

                        break;
                }

                //guardar historial pago cita
                HistorialPagoCita::query()->create([
                    'referencia_autorizacion' => $order_res,
                    'metodo' => $request->metodo_pago,
                    'respuesta' => json_encode((array) $charge),
                    'fecha' => Carbon::now(),
                    'pago_cita_id' => $pagoCita->id,
                ]);


                return redirect()->to($url);
            }else {
                return redirect()->back()->withErrors(['error' => 'error al hacer el pago']);
            }
        } catch (Exception $e) {
            //dd($e);
            abort(404);
        }
    }*/

    public function store_profesional(Request $request)
    {
        try {
            $pagoCita = PagoCita::query()
                ->where('id', '=', $request->pago_cita)
                ->with([
                    'cita',
                    'cita.paciente',
                    'cita.paciente.user',
                    'cita.profesional',
                    'cita.profesional.user',
                ])
                ->first();

            if (isset($pagoCita) and $pagoCita->valor != null)
            {
                // create instance OpenPay
                $openpay = Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'), 'CO');

                Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));

                // create object customer
                $paciente = $pagoCita->cita->paciente;

                $order_id = $paciente->user->id . time();

                $profesional = $pagoCita->cita->profesional;
                $cita = $pagoCita->cita;

                $customer = array(
                    'name'          => $paciente->user->nombres,
                    'last_name'     => $paciente->user->apellidos,
                    'email'         => $paciente->user->email,
                    //'phone_number'  => $paciente->celular
                    'phone_number'  => '3204321811'
                );

                $description = "Cita medica {$profesional->user->nombre_completo}"
                    . "{$cita->fecha_inicio->format('Y-m-d')} / "
                    . "{$cita->fecha_inicio->format('H:i A')} - {$cita->fecha_fin->format('H:i A')} / "
                    . "{$cita->lugar}";

                switch ($request->metodo_pago)
                {
                    case 'pse':

                        $chargeRequest =  array(
                            //'method'        => 'bank_account',
                            "order_id"      => $order_id,
                            'amount'        => $pagoCita->valor,
                            'currency'      => 'COP',
                            'iva'           => 0,
                            'customer'      => $customer,
                            'description'   => $description,
                            'redirect_url'  => route('profesional.respuesta-pago-cita')
                        );

                        $charge = $openpay->pses->create($chargeRequest);
                        $order_res = $charge->orderid;
                        $url = $charge->redirect_url;

                        break;
                    default:

                        $chargeRequest =  array(
                            'method'        => 'card',
                            'amount'        => $pagoCita->valor,
                            'currency'      => 'COP',
                            'description'   => 'Descripcion ',
                            'iva'           => 0,
                            "order_id"      => $order_id,
                            //'country'       => 'COL',
                            'send_email'    => false,
                            'confirm'       => false,
                            'customer'      => $customer,
                            'redirect_url'  => route('profesional.respuesta-pago-cita')
                        );

                        $charge = $openpay->charges->create($chargeRequest);
                        $order_res = $charge->order_id;
                        $url = $charge->payment_method->url;

                        break;
                }

                //guardar historial pago cita
                HistorialPagoCita::query()->create([
                    'referencia_autorizacion' => $order_res,
                    'metodo' => $request->metodo_pago,
                    'respuesta' => json_encode((array) $charge),
                    'fecha' => Carbon::now(),
                    'pago_cita_id' => $pagoCita->id,
                ]);

                //dd($charge);

                return redirect()->to($url);
            }else {
                return redirect()->back()->withErrors(['error' => 'error al hacer el pago']);
            }
        } catch (Exception $e) {
            //dd($e);
            abort(404);
        }
    }

    public function response_profesional(Request $request)
    {
        try {

            // create instance OpenPay
            $openpay = Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'), 'CO');

            Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));

            $charge = $openpay->charges->get($request->id);

            //Guardar respuesta
            $respuesta = $this->clearKeys((array) $charge);

            $historial = HistorialPagoCita::query()->updateOrCreate(
                ['referencia_autorizacion'  => $charge->order_id] , [
                'metodo'                    => $charge->method,
                'respuesta'                 => $respuesta,
                'fecha'                     => Carbon::make($charge->creation_date),
                'estado'                    => ($charge->status == 'completed') ? 1:0,
            ]);

            //dd($historial->respuesta);

            //Validar el pago
            if (isset($historial->pago_cita) and $historial->estado == 1)
            {
                $historial->pago_cita->update([
                    'aprobado'                  => 1,
                    'referencia_autorizacion'   => $charge->order_id,
                ]);
            }

            return view('pagos.comprobantes-pago', compact('historial'));

        } catch (Exception $e) {
            //dd($e);
            abort(404);
        }

    }

    private function clearKeys(array $item): array
    {
        $array = collect($item)->mapWithKeys(function ($item, $key) {
            //Limpiar el nombre
            $key = preg_match('/^\x00(?:.*?)\x00(.+)/', $key, $matches) ? $matches[1] : $key;

            //Limpiar los atributos
            if (is_object($item)) $item = $this->clearKeys((array) $item);

            //Limpiar si atrae un array de objetos
            if (is_array($item))
            {
                $a = array();
                foreach ($item as $k => $i)
                {
                    if (!is_object($i))
                    {
                        $a[$k] = $i;
                    }
                }
                $item = $a;
            }
            return [$key => $item];
        });

        return $array->toArray();
    }








    public function detalle_institcion (Request $request) {

        $pagoCita = PagoCita::query()
            ->where('id', '=', $request->pago_cita)
            ->with([
                'cita',
                'cita.especialidad',
                'cita.paciente',
                'cita.paciente.user',
                'cita.profesional_ins',
                'cita.profesional_ins.institucion',
            ])
            ->first();

        if (empty($pagoCita)) abort(404);

        return view('pagos.detalles-pago-ins', compact('pagoCita'));
    }
}
