<?php

class ConversorMatriz
{
    // Converte "1 2\n3 4" em [[1.0, 2.0], [3.0, 4.0]] ou retorna uma mensagem de erro.
    public function textoParaMatriz($texto) {
        $matriz = [];

        foreach (preg_split('/\R/', (string) $texto) as $linha) {
            $linha = trim($linha);

            if ($linha === '') {
                continue;
            }

            $valores = $this->lerNumeros($linha);

            if (is_string($valores)) {
                return $valores;
            }

            $matriz[] = $valores;
        }

        if (count($matriz) == 0) {
            return "Matriz vazia";
        }

        return $matriz;
    }

    // Converte "1 2 3" em [1.0, 2.0, 3.0] ou retorna uma mensagem de erro.
    public function textoParaVetor($texto) {
        $texto = trim((string) $texto);

        if ($texto === '') {
            return "Vetor vazio";
        }

        return $this->lerNumeros($texto);
    }

    private function lerNumeros($linha) {
        $numeros = [];

        foreach (preg_split('/\s+/', $linha) as $item) {
            $item = str_replace(',', '.', $item); // aceita vírgula decimal

            if (!is_numeric($item)) {
                return "Valor inválido: \"" . $item . "\"";
            }

            $numeros[] = (float) $item;
        }

        return $numeros;
    }
}
