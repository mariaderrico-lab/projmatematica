<?php

require_once __DIR__ . '/ValidadorMatriz.php';

class SistemaLinearCalculator
{
    const EPSILON = 1e-10;

    const DETERMINADO = "Sistema possível e determinado";
    const INDETERMINADO = "Sistema possível e indeterminado";
    const IMPOSSIVEL = "Sistema impossível";

    public function classificar(array $coeficientes, array $termos) {
        $erro = $this->validarEntrada($coeficientes, $termos);
        if ($erro !== null) {
            return $erro;
        }

        return $this->eliminar($coeficientes, $termos)["tipo"];
    }

    public function resolver(array $coeficientes, array $termos) {
        $erro = $this->validarEntrada($coeficientes, $termos);
        if ($erro !== null) {
            return $erro;
        }

        $resultado = $this->eliminar($coeficientes, $termos);

        if ($resultado["tipo"] !== self::DETERMINADO) {
            return $resultado["tipo"];
        }

        return $resultado["solucao"];
    }

    private function validarEntrada(array $coeficientes, array $termos) {
        $validador = new ValidadorMatriz();

        $erro = $validador->validar($coeficientes);
        if ($erro !== null) {
            return $erro;
        }

        $erro = $validador->validarVetor($termos);
        if ($erro !== null) {
            return $erro;
        }

        if (count($termos) != count($coeficientes)) {
            return "O vetor de termos deve ter o mesmo número de linhas da matriz";
        }

        return null;
    }

    private function eliminar(array $coeficientes, array $termos) {
        $m = count($coeficientes);
        $n = count($coeficientes[0]);
        $termos = array_values($termos);

        $aug = [];
        for ($i = 0; $i < $m; $i++) {
            $linha = array_map('floatval', array_values($coeficientes[$i]));
            $linha[] = (float) $termos[$i];
            $aug[] = $linha;
        }

        $posto = 0;
        $colunasPivo = [];

        for ($c = 0; $c < $n && $posto < $m; $c++) {
            $melhor = $posto;

            for ($l = $posto + 1; $l < $m; $l++) {
                if (abs($aug[$l][$c]) > abs($aug[$melhor][$c])) {
                    $melhor = $l;
                }
            }

            if (abs($aug[$melhor][$c]) < self::EPSILON) {
                continue; // coluna sem pivô
            }

            $temp = $aug[$melhor];
            $aug[$melhor] = $aug[$posto];
            $aug[$posto] = $temp;

            $pivo = $aug[$posto][$c];
            for ($j = $c; $j <= $n; $j++) {
                $aug[$posto][$j] /= $pivo;
            }

            for ($l = 0; $l < $m; $l++) {
                if ($l == $posto) {
                    continue;
                }

                $fator = $aug[$l][$c];

                if ($fator != 0) {
                    for ($j = $c; $j <= $n; $j++) {
                        $aug[$l][$j] -= $fator * $aug[$posto][$j];
                    }
                }
            }

            $colunasPivo[] = $c;
            $posto++;
        }

        for ($l = $posto; $l < $m; $l++) {
            if (abs($aug[$l][$n]) > self::EPSILON) {
                return ["tipo" => self::IMPOSSIVEL, "solucao" => null];
            }
        }

        if ($posto < $n) {
            return ["tipo" => self::INDETERMINADO, "solucao" => null];
        }

        $solucao = array_fill(0, $n, 0.0);
        foreach ($colunasPivo as $i => $c) {
            $solucao[$c] = round($aug[$i][$n], 10);
        }

        return ["tipo" => self::DETERMINADO, "solucao" => $solucao];
    }
}
