<?php

class ConversorMatriz
{
    public function textoParaMatriz(string $texto) {
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

    public function textoParaVetor(string $texto) {
        $texto = trim((string) $texto);

        if ($texto === '') {
            return "Vetor vazio";
        }

        return $this->lerNumeros($texto);
    }

    private function lerNumeros(string $linha) {
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
