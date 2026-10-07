<?php

class ValidadorMatriz
{
    public function validar(array $matriz) {
        if (!is_array($matriz) || count($matriz) == 0) {
            return "Matriz vazia";
        }

        $colunas = null;

        foreach ($matriz as $linha) {
            if (!is_array($linha) || count($linha) == 0) {
                return "Matriz inválida: cada linha deve ter ao menos um valor";
            }

            if ($colunas === null) {
                $colunas = count($linha);
            } elseif (count($linha) != $colunas) {
                return "Matriz irregular: todas as linhas devem ter o mesmo número de colunas";
            }

            foreach ($linha as $valor) {
                if (!is_numeric($valor) || !is_finite((float) $valor)) {
                    return "A matriz deve conter apenas valores numéricos";
                }
            }
        }

        return null;
    }

    public function validarVetor(array $vetor) {
        if (!is_array($vetor) || count($vetor) == 0) {
            return "Vetor vazio";
        }

        foreach ($vetor as $valor) {
            if (!is_numeric($valor) || !is_finite((float) $valor)) {
                return "O vetor deve conter apenas valores numéricos";
            }
        }

        return null;
    }
}
