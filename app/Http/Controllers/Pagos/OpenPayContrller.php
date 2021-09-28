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
                    //'email'         => $request->user()->email,
                    'email'         => 'cesaralejandroantolinez@gmail.com',
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
                        $url = $charge->payment_method->url;

                        break;
                    case 'pse':
                        // create object charge
                        $chargeRequest =  array(
                            'amount'        => $tipo_pago->valor * 12,//12 meses o 1 año
                            'currency'      => 'COP',
                            'description'   => __('pagos.membresía') . " " . $tipo_pago->Nombre,
                            //"send_email"    => true,
                            //"confirm"       => false,
                            'iva'           => '19',
                            //'device_session_id' => $request->deviceSessionId,
                            'customer'      => $customer,
                            "order_id"      => $order_id,
                            'redirect_url'  => route('pay-openPay-response')
                        );

                        $charge = $openpay->pses->create($chargeRequest);

                        $url = $charge->redirect_url;
                        break;
                }

                //guardar historial pago
                $historial = new HistorialPagos();
                $historial->token               = $charge->order_id;
                $historial->valor               = $charge->amount;
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


    public function response_page(Request $request)
    {
        dd($request);
    }
}
