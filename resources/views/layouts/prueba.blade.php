<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <script>
        window.paceOptions = {
            // Only show the progress on regular and ajax-y page navigation,
            // not every request
            restartOnRequestAfter: 5,

            ajax: {
                trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE'],
                trackWebSockets: true,
                ignoreURLs: []
            }
        };

    </script>
    <script src="https://unpkg.com/pace-js@1.0.2/pace.min.js"></script>
    <link href="{{ asset('plugins/pace/templates/pace-theme-loading-bar.tmpl.css') }}" rel="stylesheet" />

    <script>window.fetch = undefined;</script>
    <script src="https://unpkg.com/whatwg-fetch@latest/dist/fetch.umd.js"></script>

</head>
<body>


<p>
    <button id="do-get1">Do AJAX (XMLHttpRequest)</button>
</p>

<p>
    <button id="do-get2">Do AJAX (jQuery)</button>
</p>

<p>
    <button id="do-get3">Do AJAX (fetch) - with workaround</button>
</p>




<script>
    $(() => {
        $('#do-get1').on('click', () => {
            const oReq = new XMLHttpRequest();
            oReq.addEventListener('load', function reqListener() {
                console.dir(this.responseText);
            });
            oReq.open('GET', 'https://jsonplaceholder.typicode.com/posts');
            oReq.send();
        });

        $('#do-get2').on('click', () => {
            $.ajax('https://jsonplaceholder.typicode.com/posts').done(data => console.dir(data));
        });

        $('#do-get3').on('click', () => {
            fetch('https://jsonplaceholder.typicode.com/todos')
                .then(response => response.json())
                .then(json => console.dir(json));
        });
    });

</script>
</body>
</html>
