<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Richiesta Revisore</title>
</head>
<body>
    <h1>Richiesta per diventare Revisore</h1>
    <p>{{$revisorRequest['name']}} vuole diventare revisore</p>
    <p>la sua email è: {{$revisorRequest['email']}} </p>
    <h4>Volgio diventare revisore perché:</h4>
    <p>{{$revisorRequest['motivation']}}</p>
    <a class="btn-custom rounded-pill" href="http://localhost:8000/revisor/{{$revisorRequest['email']}}/confirm"> Rendi revisore</a>
</body>
</html>