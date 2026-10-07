<?php

require_once __DIR__ . '/../Model/Matriz.php';
require_once __DIR__ . '/../Model/SistemaLinear.php';
require_once __DIR__ . '/../Calculos/ConversorMatriz.php';
require_once __DIR__ . '/../Calculos/SomaCalculator.php';
require_once __DIR__ . '/../Calculos/MultiplicacaoCalculator.php';
require_once __DIR__ . '/../Calculos/TransposicaoCalculator.php';
require_once __DIR__ . '/../Calculos/DeterminanteCalculator.php';
require_once __DIR__ . '/../Calculos/SistemaLinearCalculator.php';

class MatrizController
{
    public function operacoes()
    {
        return [
            "soma" => "Soma de matrizes (A + B)",
            "multiplicacao" => "Multiplicação de matrizes (A × B)",
            "transposicao" => "Transposição de A",
            "determinante" => "Determinante de A",
            "singular" => "Verificar se A é singular",
            "sistema" => "Resolver sistema linear (A·x = b)"
        ];
    }

    public function calcular()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return null;
        }

        $operacao = $_POST['operacao'] ?? '';
        $operacoes = $this->operacoes();

        if (!isset($operacoes[$operacao])) {
            return $this->resposta("Operação", "Operação inválida");
        }

        $titulo = $operacoes[$operacao];
        $conversor = new ConversorMatriz();

        $a = $conversor->textoParaMatriz($_POST['matrizA'] ?? '');
        if (is_string($a)) {
            return $this->resposta($titulo, $a);
        }
        $matrizA = new Matriz($a);

        if ($operacao === "soma" || $operacao === "multiplicacao") {
            $b = $conversor->textoParaMatriz($_POST['matrizB'] ?? '');
            if (is_string($b)) {
                return $this->resposta($titulo, $b);
            }
            $matrizB = new Matriz($b);

            if ($operacao === "soma") {
                $calculadora = new SomaCalculator();
                return $this->resposta($titulo, $calculadora->somar($matrizA->valores, $matrizB->valores));
            }

            $calculadora = new MultiplicacaoCalculator();
            return $this->resposta($titulo, $calculadora->multiplicar($matrizA->valores, $matrizB->valores));
        }

        if ($operacao === "transposicao") {
            $calculadora = new TransposicaoCalculator();
            return $this->resposta($titulo, $calculadora->transpor($matrizA->valores));
        }

        if ($operacao === "determinante") {
            $calculadora = new DeterminanteCalculator();
            return $this->resposta($titulo, $calculadora->calcular($matrizA->valores));
        }

        if ($operacao === "singular") {
            $calculadora = new DeterminanteCalculator();
            $singular = $calculadora->ehSingular($matrizA->valores);

            if (is_bool($singular)) {
                $texto = $singular
                    ? "A matriz é singular (determinante nulo, não possui inversa)."
                    : "A matriz não é singular (possui inversa).";
                return $this->resposta($titulo, $texto, "texto");
            }

            return $this->resposta($titulo, $singular);
        }

        // Sistema linear
        $termos = $conversor->textoParaVetor($_POST['termos'] ?? '');
        if (is_string($termos)) {
            return $this->resposta($titulo, $termos);
        }

        $calculadora = new SistemaLinearCalculator();
        $sistema = new SistemaLinear($matrizA->valores, $termos);
        $sistema->classificacao = $calculadora->classificar($sistema->coeficientes, $sistema->termos);
        $sistema->solucao = $calculadora->resolver($sistema->coeficientes, $sistema->termos);

        $resposta = $this->resposta($titulo, $sistema->solucao);

        if (is_array($sistema->solucao)) {
            $resposta["classificacao"] = $sistema->classificacao;
        }

        return $resposta;
    }

    // Monta a resposta que a View sabe exibir: tipo = erro | texto | numero | matriz | vetor
    private function resposta($titulo, $valor, $tipo = null)
    {
        if ($tipo === null) {
            if (is_string($valor)) {
                $tipo = "erro";
            } elseif (is_array($valor) && is_array($valor[0])) {
                $tipo = "matriz";
            } elseif (is_array($valor)) {
                $tipo = "vetor";
            } else {
                $tipo = "numero";
            }
        }

        return ["operacao" => $titulo, "tipo" => $tipo, "valor" => $valor, "classificacao" => null];
    }
}
