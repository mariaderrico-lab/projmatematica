<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Calculos/MultiplicacaoCalculator.php';

class MultiplicacaoCalculatorTest extends TestCase
{
    public function testMultiplicacaoDeMatrizes2x2() {
        $calculadora = new MultiplicacaoCalculator();
        $resultado = $calculadora->multiplicar([[1, 2], [3, 4]], [[5, 6], [7, 8]]);
        $this->assertEqualsWithDelta([[19, 22], [43, 50]], $resultado, 0.000001);
    }

    public function testMultiplicacaoDeMatrizesNaoQuadradas() {
        $calculadora = new MultiplicacaoCalculator();
        $resultado = $calculadora->multiplicar(
            [[1, 2, 3], [4, 5, 6]],
            [[7, 8], [9, 10], [11, 12]]
        );
        $this->assertEqualsWithDelta([[58, 64], [139, 154]], $resultado, 0.000001);
    }

    public function testMultiplicacaoPelaIdentidade() {
        $calculadora = new MultiplicacaoCalculator();
        $resultado = $calculadora->multiplicar([[1, 2], [3, 4]], [[1, 0], [0, 1]]);
        $this->assertEqualsWithDelta([[1, 2], [3, 4]], $resultado, 0.000001);
    }

    public function testMultiplicacaoPelaMatrizNula() {
        $calculadora = new MultiplicacaoCalculator();
        $resultado = $calculadora->multiplicar([[1, 2], [3, 4]], [[0, 0], [0, 0]]);
        $this->assertEqualsWithDelta([[0, 0], [0, 0]], $resultado, 0.000001);
    }

    public function testMultiplicacaoDeMatrizes1x1() {
        $calculadora = new MultiplicacaoCalculator();
        $resultado = $calculadora->multiplicar([[3]], [[4]]);
        $this->assertEqualsWithDelta([[12]], $resultado, 0.000001);
    }

    public function testMultiplicacaoComPontoFlutuante() {
        $calculadora = new MultiplicacaoCalculator();
        $resultado = $calculadora->multiplicar([[0.1]], [[0.3]]);
        $this->assertEqualsWithDelta([[0.03]], $resultado, 0.000001);
    }

    public function testDimensoesIncompativeis() {
        $calculadora = new MultiplicacaoCalculator();
        $resultado = $calculadora->multiplicar([[1, 2]], [[1, 2]]);
        $this->assertEquals("Dimensões incompatíveis para multiplicação", $resultado);
    }

    public function testMatrizAVazia() {
        $calculadora = new MultiplicacaoCalculator();
        $resultado = $calculadora->multiplicar([], [[1]]);
        $this->assertEquals("Matriz vazia", $resultado);
    }

    public function testMatrizBComValorNaoNumerico() {
        $calculadora = new MultiplicacaoCalculator();
        $resultado = $calculadora->multiplicar([[1]], [["x"]]);
        $this->assertEquals("A matriz deve conter apenas valores numéricos", $resultado);
    }
}
