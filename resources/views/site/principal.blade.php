<!DOCTYPE html>
<html>

<head>
    <title>Calculadora de Horas</title>
    <link rel="stylesheet" href="{{ asset('css/estiloBasico.css') }}" type="text/css" href="style.css">
</head>

<body>
    <h1>Calculadora de Horas</h1>
    <form action={{ route('site.principal') }} method="post">
        @csrf {{--  token laravel para post  --}}
        <label for="hora_inicial">Hora Inicial:</label>
        <input type="time" name="hora_inicial" required><br>

        <label for="hora_final">Hora Final:</label>
        <input type="time" name="hora_final" required><br>

        <input type="submit" value="Calcular">
    </form>
    
    @if(isset($horas_diurnas) && isset($horas_noturnas))
    <p>Horas Diurnas: {{ $horas_diurnas }}
    <p>Horas Noturnas: {{ $horas_noturnas }}
    @endif

</body>
</html>
