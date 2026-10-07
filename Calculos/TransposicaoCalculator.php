<?php

require_once __DIR__ . '/ValidadorMatriz.php';

class TransposicaoCalculator
{
    public function transpor($matriz) {
        $validador = new ValidadorMatriz();

        $erro = $validador->validar($matriz);
        if ($erro !== null) {
            return $erro;
        }

        $resultado = [];

        for ($i = 0; $i < count($matriz); $i++) {
            for ($j = 0; $j < count($matriz[0]); $j++) {
                $resultado[$j][$i] = $matriz[$i][$j];
            }
        }

        return $resultado;
    }
}
