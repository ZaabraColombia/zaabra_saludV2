<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/cubeportfolio-full/css/cubeportfolio.min.css') }}">

    <title>Hello, world!</title>
</head>
<body>
<h1>Hello, world!</h1>

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="u-cubeportfolio">
                <!-- Filter -->
                <ul id="filterControls" class="list-inline cbp-l-filters-alignRight text-center">
                    <li class="list-inline-item cbp-filter-item cbp-filter-item-active u-cubeportfolio__item" data-filter="*">All</li>
                    <li class="list-inline-item cbp-filter-item u-cubeportfolio__item" data-filter=".team1">Branding</li>
                    <li class="list-inline-item cbp-filter-item u-cubeportfolio__item" data-filter=".team2">Abstract</li>
                    <li class="list-inline-item cbp-filter-item u-cubeportfolio__item" data-filter=".team3">Graphic</li>
                </ul>
                <!-- End Filter -->

                <!-- Content -->
                <div id="grid-container">
                    <div class="cbp-item team1">
                        <img src="{{ asset('img/user/4/35fc5b81330959.5cfc8b03cda3b.png') }}" alt="custom alt 1" width="100%">
                    </div>
                    <div class="cbp-item team2">
                        <img src="{{ asset('img/user/4/35fc5b81330959.5cfc8b03cda3b.png') }}" alt="custom alt 2" width="100%">
                    </div>
                    <div class="cbp-item team3">
                        <img src="{{ asset('img/user/4/35fc5b81330959.5cfc8b03cda3b.png') }}" alt="custom alt 3" width="100%">
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
</section>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="{{ asset('plugins/cubeportfolio-full/js/jquery.cubeportfolio.min.js') }}"></script>

<script type="text/javascript">
    jQuery(document).ready( function() {
        jQuery('#grid-container').cubeportfolio({
            filters: '#filterControls'
        });
    });
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
-->
</body>
</html>
