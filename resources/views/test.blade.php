<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/openPay.css') }}">

    <title>Hello, world!</title>
</head>
<body>
<section class="container">
    <div class="bkng-tb-cntnt">
        <div class="pymnts">
            <form action="{{ route('pay-openPay') }}" method="post" id="payment-form">
                <input type="hidden" name="token_id" id="token_id">
                <div class="pymnt-itm card active">
                    <h2>Tarjeta de crédito o débito</h2>
                    <div class="pymnt-cntnt">
                        <div class="card-expl">
                            <div class="credit">
                                <h4>Tarjetas de crédito</h4>
                            </div>
                            <div class="debit">
                                <h4>Tarjetas de débito</h4>
                            </div>
                        </div>
                        <div class="sctn-row">
                            <div class="sctn-col l">
                                <label>Nombre del titular</label>
                                <input type="text" placeholder="Nombre" autocomplete="off" data-openpay-card="holder_name">
                            </div>
                            <div class="sctn-col l">
                                <label>Apellido del titular</label>
                                <input type="text" placeholder="Apellido" autocomplete="off" data-openpay-card="holder_last_name">
                            </div>
                            <div class="sctn-col l">
                                <label>Correo</label>
                                <input type="text" placeholder="Correo" autocomplete="off" data-openpay-card="holder_email">
                            </div>
                            <div class="sctn-col">
                                <label>Número de tarjeta</label>
                                <input type="text" autocomplete="off" data-openpay-card="card_number">
                            </div>
                        </div>
                        <div class="sctn-row">
                            <div class="sctn-col l">
                                <label>Fecha de expiración</label>
                                <div class="sctn-col half l">
                                    <input type="text" placeholder="Mes" data-openpay-card="expiration_month">
                                </div>
                                <div class="sctn-col half l">
                                    <input type="text" placeholder="Año" data-openpay-card="expiration_year">
                                </div>
                            </div>
                            <div class="sctn-col cvv"><label>Código de seguridad</label>
                                <div class="sctn-col half l">
                                    <input type="text" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2">
                                </div>
                            </div>
                        </div>
                        <div class="openpay"><div class="logo">Transacciones realizadas vía:</div>
                            <div class="shield">Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
                        </div>
                        <div class="sctn-row">
                            <a class="button rght" id="pay-button">Pagar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        OpenPay.setId('mafv81egbikkeaidfgzc');
        OpenPay.setApiKey('sk_a446cf5cb62a46679f0a77f3cb33f6f7');
        OpenPay.setSandboxMode(false);
        //Se genera el id de dispositivo
        var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");

        $('#pay-button').on('click', function(event) {
            event.preventDefault();
            $("#pay-button").prop( "disabled", true);
            OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);
        });

        var sucess_callbak = function(response) {
            var token_id = response.data.id;
            $('#token_id').val(token_id);
            $('#payment-form').submit();
        };

        var error_callbak = function(response) {
            var desc = response.data.description !== undefined ? response.data.description : response.message;
            console.log("ERROR [" + response.status + "] " + desc);
            alert("ERROR [" + response.status + "] " + desc);
            $("#pay-button").prop("disabled", false);
        };

    });
</script>
</body>
</html>
