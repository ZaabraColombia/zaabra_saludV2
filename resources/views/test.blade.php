<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<h1>Hello, world!</h1>

<section class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('profesional.pago-cita') }}" method="post">
                <input type="hidden" id="pago_cita" name="pago_cita" value="{{ request('pago_cita') }}"/>
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Well done!</h4>
                        <p>{{ session('error') }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="metodo_pago" id="metodo-pse" value="pse" checked>
                    <label class="form-check-label" for="metodo-pse">
                        PSE
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="metodo_pago" id="metodo-card" value="card">
                    <label class="form-check-label" for="metodo-card">
                        Tarjeta de crédito
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Pagar</button>
            </form>
        </div>
    </div>
</section>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


<script type="text/javascript"></script>
</body>
</html>
