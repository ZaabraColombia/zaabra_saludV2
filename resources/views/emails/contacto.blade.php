<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
<section>

    <table style="border: 1px solid black">
        <tbody>
        <tr>
            <td>Tipo</td>
            <td>{{ $contact['tipo_contacto'] }}</td>
        </tr>
        <tr>
            <td>Correo</td>
            <td>{{ $contact['email'] }}</td>
        </tr>
        @if($contact['tipo_contacto'] == 'Institución')
            <tr>
                <td>Nombre Institución</td>
                <td>{{ $contact['nombreinstitucion'] }}</td>
            </tr>
        @else
            <tr>
                <td>Primer nombre</td>
                <td>{{ $contact['primernombre'] }}</td>
            </tr>
            <tr>
                <td>Segundo nombre</td>
                <td>{{ $contact['segundonombre'] }}</td>
            </tr>
            <tr>
                <td>Primer apellido</td>
                <td>{{ $contact['primerapellido'] }}</td>
            </tr>
            <tr>
                <td>Segundo apellido</td>
                <td>{{ $contact['segundoapellido'] }}</td>
            </tr>
        @endif
        <tr>
            <td>Asunto</td>
            <td>{{ $contact['asunto'] }}</td>
        </tr>
        </tbody>
    </table>
</section>
</body>
</html>
