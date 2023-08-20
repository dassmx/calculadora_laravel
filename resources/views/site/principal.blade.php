<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Horas</title>
    <link rel="stylesheet" href="{{asset('css/estiloBasico.css')}}" type="text/css" href="style.css">
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
</body>
</html>

<?php
$hora_inicial = $_POST['hora_inicial'];
$hora_final = $_POST['hora_final'];

// Converte as horas para o formato de timestamp
$timestamp_inicial = strtotime($hora_inicial);
$timestamp_final = strtotime($hora_final);

// Calcula a diferença em segundos
$diferenca_segundos = $timestamp_final - $timestamp_inicial;

// Converte a diferença para horas
$horas_trabalhadas = $diferenca_segundos / 3600;

// Regras de negócios
$horas_diurnas = 0;
$horas_noturnas = 0;

if ($horas_trabalhadas > 0) {
    $hora_inicio_diurno = strtotime('05:00');
    $hora_fim_diurno = strtotime('22:00');

    if ($timestamp_inicial >= $hora_fim_diurno || $timestamp_final <= $hora_inicio_diurno) {
        // Horas noturnas
        $horas_noturnas = $horas_trabalhadas;
    } elseif ($timestamp_inicial >= $hora_inicio_diurno && $timestamp_final <= $hora_fim_diurno) {
        // Horas diurnas
        $horas_diurnas = $horas_trabalhadas;
    } else {
        // Parte diurna e parte noturna
        if ($timestamp_inicial < $hora_inicio_diurno) {
            $horas_noturnas += ($hora_inicio_diurno - $timestamp_inicial) / 3600;
        }
        if ($timestamp_final > $hora_fim_diurno) {
            $horas_noturnas += ($timestamp_final - $hora_fim_diurno) / 3600;
        }
        $horas_diurnas = $horas_trabalhadas - $horas_noturnas;
    }
}

// Exibir resultados
echo "Horas Diurnas: $horas_diurnas<br>";
echo "Horas Noturnas: $horas_noturnas";
?>