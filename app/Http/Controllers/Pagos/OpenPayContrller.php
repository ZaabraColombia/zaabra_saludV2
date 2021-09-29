<?php

namespace App\Http\Controllers\Pagos;

use App\Http\Controllers\Controller;
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

//require_once '../vendor/autoload.php';

class OpenPayContrller extends Controller
{
    /**
     * Create charge in OpenPay
     * https://www.openpay.mx/docs/api/?php#redireccion
     *
     */
    public function store(Request $request)
    {
        try {
            $tipo_pago = TipoPago::where('id', '=', $request->id_tipo_pago)->first();

            if (isset($tipo_pago) and $tipo_pago->valor != null)
            {
                // create instance OpenPay
                $openpay = Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'), 'CO');

                Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));

                // create object customer
                $customer = array(
                    'name'          => $request->user()->primernombre,
                    'last_name'     => $request->user()->primerapellido,
                    'email'         => $request->user()->email,
                    'id_type_pay'   => $request->id_tipo_pago
                );

                $order_id = $request->user()->id . time();

                switch ($request->metodo_pago)
                {
                    default:
                        // create object charge
                        $chargeRequest =  array(
                            'method'        => 'card',
                            //'source_id'     => ,
                            'amount'        => $tipo_pago->valor * 12,//12 meses o 1 año
                            'currency'      => 'COP',
                            "order_id"      => $order_id,
                            'description'   => __('pagos.membresía') . " " . $tipo_pago->Nombre,
                            "send_email"    => true,
                            "confirm"       => false,
                            //'device_session_id' => $request->deviceSessionId,
                            'customer'      => $customer,
                            'redirect_url'  => route('pay-openPay-response')
                        );

                        $charge = $openpay->charges->create($chargeRequest);

                        $order_res = $charge->order_id;
                        $url = $charge->payment_method->url;
                        $valor = $charge->amount;

                        break;
                    case 'pse':
                        // create object charge
                        $chargeRequest =  array(
                            'amount'        => $tipo_pago->valor * 12,//12 meses o 1 año
                            'currency'      => 'COP',
                            'description'   => __('pagos.membresía') . " " . $tipo_pago->Nombre,
                            //"send_email"    => true,
                            //"confirm"       => false,
                            'iva'           => '0',
                            //'device_session_id' => $request->deviceSessionId,
                            'customer'      => $customer,
                            "order_id"      => $order_id,
                            'redirect_url'  => route('pay-openPay-response')
                        );

                        $charge = $openpay->pses->create($chargeRequest);

                        $url = $charge->redirect_url;
                        $order_res = $charge->orderid;
                        $valor = $tipo_pago->valor * 12;
                        break;
                }

                //guardar historial pago
                $historial = new HistorialPagos();
                $historial->order_id            = $order_res;
                $historial->valor               = $valor;
                $historial->respuesta           = json_encode((array) $charge);
                $historial->fecha_generar_pago  = date('Y-m-d h:s:i');
                $historial->id_usuario          = $request->user()->id;
                $historial->id_tipo_pago        = $request->id_tipo_pago;
                $historial->save();

                return redirect()->to($url);
            }else {
                return redirect()->back()->withErrors(['error' => __('pagos.valor')]);
            }
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
            return response()->json([
                'error' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ]);
        }
    }


    /**
     * Recibe la transacción de pse o pago con tarjeta
     *
     * @param Request $request
     */
    public function response_page(Request $request)
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
