<?php

namespace App\Http\Controllers\Pagos;

use App\Models\HistorialPagos;
use App\Models\pagos;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use Openpay;
use Exception;
use OpenpayApiError;
use OpenpayApiAuthError;
use OpenpayApiRequestError;
use OpenpayApiConnectionError;
use OpenpayApiTransactionError;

class CitaOpenPay
{
    /**
     * @param $cita
     * @param $pagoCita
     * @param $profesional
     * @param $paciente
     * @return void|string
     */
    public function store($cita, $pagoCita, $profesional, $paciente)
    {
        try {
            // create instance OpenPay
            $openpay = Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'), 'CO');

            Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));

            // create object customer
            $customer = array(
                'name'          => $paciente->user->nombres,
                'last_name'     => $paciente->user->apellidos,
                'email'         => $paciente->user->email,
                'phone_number'  => $paciente->celular
            );

            $order_id = $paciente->user->id . time();

            $chargeRequest =  array(
                //'method'        => 'card',
                //'source_id'     => ,
                'amount'        => $pagoCita->valor,
                'currency'      => 'COP',
                "order_id"      => $order_id,
                'description'   => "Cita medica {$profesional->user->nombre_completo} \n"
                    . "{$cita->fecha_inicio->format('Y-m-d')} / "
                    . "{$cita->fecha_inicio->format('H:i A')} - {$cita->fecha_fin->format('H:i A')} \n"
                    . "{$cita->lugar}",
                "send_email"    => true,
                "confirm"       => false,
                //'device_session_id' => $request->deviceSessionId,
                'customer'      => $customer,
                'redirect_url'  => route('respuesta-pago-cita')
            );

            switch ($pagoCita->tipo)
            {
                default:

                    $chargeRequest['method'] = 'card';

                    $charge = $openpay->charges->create($chargeRequest);

                    $url = $charge->payment_method->url;

                    break;
                case 'pse':

                    $chargeRequest['iva'] = 0;

                    $charge = $openpay->pses->create($chargeRequest);

                    $url = $charge->redirect_url;

                    break;
            }

            return $url;

        } catch (Exception $e) {
            abort(404);
        }
    }


    public function response_page($request)
    {

        try {

            // create instance OpenPay
            $openpay = Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'), 'CO');

            Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));

            $charge = $openpay->charges->get($request->id);

            $historia_pago = HistorialPagos::where('order_id', '=', $charge->order_id)->first();

            //Validar en caso que no este registrado el resivo
            if (isset($historia_pago))
            {

                $historia_pago->order_id            = $charge->order_id;
                $historia_pago->transaccion_id      = $charge->id;
                $historia_pago->metodo              = $charge->method;
                $historia_pago->valor               = $charge->amount;
                $historia_pago->respuesta           = json_encode((array) $charge);
                $historia_pago->fecha_pago          = $charge->operation_date;
                $historia_pago->estado              = ($charge->status == 'completed') ? 1:0;

                $historia_pago->save();
            }else{
                $historia_pago = new HistorialPagos();
                $historia_pago->order_id            = $charge->order_id;
                $historia_pago->transaccion_id      = $charge->id;
                $historia_pago->metodo              = $charge->method;
                $historia_pago->valor               = $charge->amount;
                $historia_pago->estado              = ($charge->status == 'completed') ? 1:0;
                $historia_pago->respuesta           = json_encode((array) $charge);
                $historia_pago->fecha_generar_pago  = $charge->creation_date;
                $historia_pago->fecha_pago          = $charge->operation_date;
                $historia_pago->id_usuario          = substr($charge->order_id, 0, -10);//obtengo el id del usuario del order id
                //$historia_pago->id_tipo_pago        = $request->id_tipo_pago;

                $historia_pago->save();
            }

            //Agregar la membresia
            if ($historia_pago->estado and isset($historia_pago->id_tipo_pago))
            {


                //solo para membresia noral para profesional e instituciones
                switch ($historia_pago->id_tipo_pago)
                {
                    case 13:
                    case 16:
                        $pago = pagos::where('numeroAutorizacion', '=', $historia_pago->order_id)->first();

                        if (empty($pago))
                        {
                            $pago = new pagos();

                            $pago->fecha        = $historia_pago->fecha_pago;//el plan inicia desde el pago
                            $pago->fechaFin     = date('Y-m-d h:i:s', strtotime($historia_pago->fecha_pago . "+ 1 year"));
                            $pago->idUsuario    = $historia_pago->id_usuario;
                            $pago->idtipopago   = $historia_pago->id_tipo_pago;
                            $pago->valor        = $historia_pago->valor;
                            $pago->aprobado     = 1;
                            $pago->numeroAutorizacion     = $historia_pago->order_id;//el número de transacción es el order id

                            $pago->save();
                        }
                        break;
                }
            }

            return redirect('/');

        } catch (OpenpayApiTransactionError $e) {
            return response()->json([
                'error' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ]);
        } catch (OpenpayApiRequestError $e) {
            return response()->json([
                'error' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ]);
        } catch (OpenpayApiConnectionError $e) {
            return response()->json([
                'error' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ]);
        } catch (OpenpayApiAuthError $e) {
            return response()->json([
                'error' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ]);
        } catch (OpenpayApiError $e) {
            return response()->json([
                'error' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ]);
        } catch (Exception $e) {
            //dd($e);
            return response()->json([
                'error' => $e
            ]);
        }

    }
}
