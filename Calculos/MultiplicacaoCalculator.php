<?php

require_once __DIR__ . '/ValidadorMatriz.php';

class MultiplicacaoCalculator
{
    public function multiplicar($a, $b) {
        $validador = new ValidadorMatriz();

        $erro = $validador->validar($a);
        if ($erro !== null) {
            return $erro;
        }

        $erro = $validador->validar($b);
        if ($erro !== null) {
            return $erro;
        }

        if (count($a[0]) != count($b)) {
            return "Dimensões incompatíveis para multiplicação";
        }

        $resultado = [];

        for ($i = 0; $i < count($a); $i++) {
            for ($j = 0; $j < count($b[0]); $j++) {
                $soma = 0;

                for ($k = 0; $k < count($b); $k++) {
                    $soma += $a[$i][$k] * $b[$k][$j];
                }

                $resultado[$i][$j] = $soma;
            }
        }

        return $resultado;
    }
}
