<?php

require_once __DIR__ . '/ValidadorMatriz.php';

class SomaCalculator
{
    public function somar(array $a, array $b) {
        $validador = new ValidadorMatriz();

        $erro = $validador->validar($a);
        if ($erro !== null) {
            return $erro;
        }

        $erro = $validador->validar($b);
        if ($erro !== null) {
            return $erro;
        }

        if (count($a) != count($b) || count($a[0]) != count($b[0])) {
            return "Dimensões incompatíveis para soma";
        }

        $resultado = [];

        for ($i = 0; $i < count($a); $i++) {
            for ($j = 0; $j < count($a[0]); $j++) {
                $resultado[$i][$j] = $a[$i][$j] + $b[$i][$j];
            }
        }

        return $resultado;
    }
}
