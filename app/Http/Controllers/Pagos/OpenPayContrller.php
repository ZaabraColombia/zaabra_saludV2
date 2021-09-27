<?php

namespace App\Http\Controllers\Pagos;

use App\Http\Controllers\Controller;
use App\Models\HistorialPagos;
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

                // create object charge
                $chargeRequest =  array(
                    'method'        => ($request->metodo_pago != null) ? $request->metodo_pago : 'card',
                    //'source_id'     => '167' . time(),
                    'amount'        => $tipo_pago->valor * 12,//12 meses o 1 año
                    'currency'      => 'COP',
                    //"order_id"      => "oid-00051",
                    'description'   => __('pagos.membresía') . " " . $tipo_pago->Nombre,
                    "send_email"    => true,
                    "confirm"       => false,
                    //'device_session_id' => $request->deviceSessionId,
                    'customer'      => $customer,
                    'redirect_url'  => route('pay-openPay-response')
                );


                $charge = $openpay->charges->create($chargeRequest);

                //guardar historial pago
                $historial = new HistorialPagos();
                $historial->token               = $charge->id;
                $historial->valor               = $charge->id;
                $historial->respuesta           = json_encode($charge);
                $historial->fecha_generar_pago  = date('Y-m-d h:s:i');
                $historial->id_usuario          = $request->user()->id;
                $historial->id_tipo_pago        = $request->id_tipo_pago;
                $historial->save();

                return redirect()->to($charge->payment_method->url);
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
            dd($e);
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


    public function response_page(Request $request)
    {
        dd($request);
    }
}
