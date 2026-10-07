<?php

require_once __DIR__ . '/ValidadorMatriz.php';

class DeterminanteCalculator
{
    const EPSILON = 1e-10;

    public function calcular(array $matriz) {
        $validador = new ValidadorMatriz();

        $erro = $validador->validar($matriz);
        if ($erro !== null) {
            return $erro;
        }

        $n = count($matriz);

        if (count($matriz[0]) != $n) {
            return "A matriz deve ser quadrada";
        }

        $a = [];
        foreach ($matriz as $linha) {
            $a[] = array_map('floatval', array_values($linha));
        }

        $determinante = 1.0;

        for ($c = 0; $c < $n; $c++) {
            $pivo = $c;

            for ($l = $c + 1; $l < $n; $l++) {
                if (abs($a[$l][$c]) > abs($a[$pivo][$c])) {
                    $pivo = $l;
                }
            }

            if (abs($a[$pivo][$c]) < self::EPSILON) {
                return 0.0;
            }

            if ($pivo != $c) {
                $temp = $a[$pivo];
                $a[$pivo] = $a[$c];
                $a[$c] = $temp;
                $determinante = -$determinante;
            }

            $determinante *= $a[$c][$c];

            for ($l = $c + 1; $l < $n; $l++) {
                $fator = $a[$l][$c] / $a[$c][$c];

                for ($k = $c; $k < $n; $k++) {
                    $a[$l][$k] -= $fator * $a[$c][$k];
                }
            }
        }

        return round($determinante, 10);
    }

    public function ehSingular(array $matriz) {
        $determinante = $this->calcular($matriz);

        if (is_string($determinante)) {
            return $determinante;
        }

        return abs($determinante) < self::EPSILON;
    }
}
