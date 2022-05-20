<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>


    <title>Hello, world!</title>
</head>
<body>
<h1>Hello, world!</h1>

<section class="container">
    <form action="#" method="post">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="pais_id">Pais: </label>
                @php $paises = \App\Models\Pais::query()->get() @endphp
                <select name="pais_id" id="pais_id" class="pais select2" data-value="" data-ciudad="#ciudad_id"
                        data-region="#region_id">
                    @if($paises->isNotEmpty())
                        @foreach($paises as $pais)
                            <option
                                value="{{ $pais->code }}" {{ old('pais_id', 'co') == $pais->code ? 'selected':'' }}>{{ $pais->nombre }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="region_id">Region: </label>
                <select name="region_id" id="region_id" class="region select2" data-value="9" data-pais="#pais_di"
                        data-ciudad="#ciudad_id"></select>
            </div>
            <div class="col-md-4 form-group">
                <label for="ciudad_id">Ciudad</label>
                <select name="ciudad_id" id="ciudad_id" class="ciudad select2" data-value=""></select>
            </div>
        </div>
    </form>
</section>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/location.js') }}"></script>

<script type="text/javascript">
    $('#pais_id').trigger('change');
</script>
</body>
</html>
