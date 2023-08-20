<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Horas</title>
    <link rel="stylesheet" href="{{asset('css/estiloBasico.css')}}" type="text/css" href="style.css">
</head>
<body>
    <h1>Calculadora de Horas</h1>
    <form action={{ route('site.principal') }} method="get">
        <label for="hora_inicial">Hora Inicial:</label>
        <input type="time" name="hora_inicial" required><br>
        
        <label for="hora_final">Hora Final:</label>
        <input type="time" name="hora_final" required><br>
        
        <input type="submit" value="Calcular">
    </form>
</body>
</html>

<?php
/*
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
    if (date('H', $timestamp_inicial) >= 6 && date('H', $timestamp_final) <= 18) {
        // Horas diurnas
        $horas_diurnas = $horas_trabalhadas;
    } else {
        // Horas noturnas
        $horas_noturnas = $horas_trabalhadas;
    }
}

// Exibir resultados
echo "Horas Diurnas: $horas_diurnas<br>";
echo "Horas Noturnas: $horas_noturnas";
*/
?>
