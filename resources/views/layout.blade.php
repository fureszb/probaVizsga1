<!DOCTYPE html>
<html lang="hu">

<head>
    <title>Feladat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Kizőldítjük a földet!</h1>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('bejegyzesek.index') }}">Publikus</a></li>
                <li><a href="#">Admin</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">

        @yield('content')
    </div>

</body>

</html>
