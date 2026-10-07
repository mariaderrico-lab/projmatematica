<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Calculos/SomaCalculator.php';

class SomaCalculatorTest extends TestCase
{
    public function testSomaDeMatrizes2x2() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([[1, 2], [3, 4]], [[5, 6], [7, 8]]);
        $this->assertEqualsWithDelta([[6, 8], [10, 12]], $resultado, 0.000001);
    }

    public function testSomaDeMatrizesNaoQuadradas() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([[1, 2, 3]], [[4, 5, 6]]);
        $this->assertEqualsWithDelta([[5, 7, 9]], $resultado, 0.000001);
    }

    public function testSomaDeMatrizes1x1() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([[2]], [[3]]);
        $this->assertEqualsWithDelta([[5]], $resultado, 0.000001);
    }

    public function testSomaComMatrizNula() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([[1, -2], [3, 4]], [[0, 0], [0, 0]]);
        $this->assertEqualsWithDelta([[1, -2], [3, 4]], $resultado, 0.000001);
    }

    public function testSomaComValoresNegativos() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([[1, -2]], [[-1, 2]]);
        $this->assertEqualsWithDelta([[0, 0]], $resultado, 0.000001);
    }

    public function testSomaComPontoFlutuante() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([[0.1]], [[0.2]]);
        $this->assertEqualsWithDelta([[0.3]], $resultado, 0.000001);
    }

    public function testDimensoesIncompativeis() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([[1, 2]], [[1], [2]]);
        $this->assertEquals("Dimensões incompatíveis para soma", $resultado);
    }

    public function testMatrizAVazia() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([], [[1]]);
        $this->assertEquals("Matriz vazia", $resultado);
    }

    public function testMatrizBIrregular() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([[1, 2]], [[1, 2], [3]]);
        $this->assertEquals(
            "Matriz irregular: todas as linhas devem ter o mesmo número de colunas",
            $resultado
        );
    }

    public function testMatrizComValorNaoNumerico() {
        $calculadora = new SomaCalculator();
        $resultado = $calculadora->somar([["a"]], [[1]]);
        $this->assertEquals("A matriz deve conter apenas valores numéricos", $resultado);
    }
}
