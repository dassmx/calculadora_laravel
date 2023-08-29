<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PrincipalController extends Controller
{
    public function principal(Request $request)
    {;
        $dados = $request->all(); //recebe horas

        if (isset($dados)) {

            // Converte as horas para minutos

            [$horas, $minutos] = explode(':', $dados['hora_inicial']);
            $minutos_inicial = $horas * 60 + $minutos;


            [$horas, $minutos] = explode(':', $dados['hora_final']);
            $minutos_final = $horas * 60 + $minutos;


            // Regras de negócios
            $minutos_diurnos = 0;
            $minutos_noturnos = 0;

            [$horas, $minutos] = explode(':', "22:00");
            $inicio_periodo_noturno = $horas * 60 + $minutos;

            [$horas, $minutos] = explode(':', "05:00");
            $inicio_periodo_diurno = $horas * 60 + $minutos;

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
            $horas_diurnas = floor($minutos_diurnos / 60) + ($minutos_diurnos % 60) / 100;

            $horas_noturnas = floor($minutos_noturnos / 60) + ($minutos_noturnos % 60) / 100;

            return view('site.principal',['horas_diurnas' => $horas_diurnas, 'horas_noturnas' => $horas_noturnas]);

            // Exibir resultados
        } else {
            return view('site.principal');
        }
    }
}
