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
</body>

</html>

<?php

$hora_inicial = $_POST['hora_inicial'];
$hora_final = $_POST['hora_final'];

// Função para converter hora em minutos
function converterParaMinutos($hora)
{
    [$horas, $minutos] = explode(':', $hora);
    return $horas * 60 + $minutos;
}

// Função para converter minutos em horas
function converterParaHoras($minutos)
{
    return floor($minutos / 60) + ($minutos % 60) / 100;
}

        // Converte as horas para minutos
        $minutos_inicial = converterParaMinutos($hora_inicial);
        $minutos_final = converterParaMinutos($hora_final);

        // Regras de negócios
        $minutos_diurnos = 0;
        $minutos_noturnos = 0;

        $inicio_periodo_noturno = converterParaMinutos("22:00");
        $inicio_periodo_diurno = converterParaMinutos("05:00");

            $i = $minutos_inicial;
            while ($i != $minutos_final) {
                if ($i >= $minutos_inicial) {
                    if ($i == $minutos_final) {
                        return;
                    }
                    if ($i >= 1440) {
                        $i = 0;
                        $minutos_noturnos++;
                    }
                    if ($i < $inicio_periodo_noturno && $i != 0) {
                        $minutos_diurnos++;
                    }
                    if ($i >= $inicio_periodo_noturno) {
                        $minutos_noturnos++;
                    }
                } else {
                    if ($i >= $inicio_periodo_diurno) {
                        $minutos_diurnos++;
                    } else {
                        $minutos_noturnos++;
                    }
                }
                $i++;
            }

        // Converter minutos para horas
        $horas_diurnas = converterParaHoras($minutos_diurnos);
        $horas_noturnas = converterParaHoras($minutos_noturnos);
    
// Exibir resultados
echo "Horas Diurnas: $horas_diurnas<br>";
echo "Horas Noturnas: $horas_noturnas";
?>
