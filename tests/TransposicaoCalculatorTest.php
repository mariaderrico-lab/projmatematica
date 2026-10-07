<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Calculos/TransposicaoCalculator.php';

class TransposicaoCalculatorTest extends TestCase
{
    public function testTransposicaoDeMatrizNaoQuadrada() {
        $calculadora = new TransposicaoCalculator();
        $resultado = $calculadora->transpor([[1, 2, 3], [4, 5, 6]]);
        $this->assertEqualsWithDelta([[1, 4], [2, 5], [3, 6]], $resultado, 0.000001);
    }

    public function testTransposicaoDeMatrizQuadrada() {
        $calculadora = new TransposicaoCalculator();
        $resultado = $calculadora->transpor([[1, 2], [3, 4]]);
        $this->assertEqualsWithDelta([[1, 3], [2, 4]], $resultado, 0.000001);
    }

    public function testTransposicaoDeMatriz1x1() {
        $calculadora = new TransposicaoCalculator();
        $resultado = $calculadora->transpor([[9]]);
        $this->assertEqualsWithDelta([[9]], $resultado, 0.000001);
    }

    public function testTransposicaoDaIdentidade() {
        $calculadora = new TransposicaoCalculator();
        $resultado = $calculadora->transpor([[1, 0], [0, 1]]);
        $this->assertEqualsWithDelta([[1, 0], [0, 1]], $resultado, 0.000001);
    }

    public function testTransposicaoDuplaRetornaOriginal() {
        $calculadora = new TransposicaoCalculator();
        $original = [[1, 2, 3], [4, 5, 6]];
        $resultado = $calculadora->transpor($calculadora->transpor($original));
        $this->assertEqualsWithDelta($original, $resultado, 0.000001);
    }

    public function testMatrizVazia() {
        $calculadora = new TransposicaoCalculator();
        $resultado = $calculadora->transpor([]);
        $this->assertEquals("Matriz vazia", $resultado);
    }

    public function testMatrizIrregular() {
        $calculadora = new TransposicaoCalculator();
        $resultado = $calculadora->transpor([[1, 2], [3]]);
        $this->assertEquals(
            "Matriz irregular: todas as linhas devem ter o mesmo número de colunas",
            $resultado
        );
    }
}
