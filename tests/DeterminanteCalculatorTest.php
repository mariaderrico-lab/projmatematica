<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Calculos/DeterminanteCalculator.php';

class DeterminanteCalculatorTest extends TestCase
{
    public function testDeterminante1x1() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([[-4]]);
        $this->assertEqualsWithDelta(-4, $resultado, 0.000001);
    }

    public function testDeterminante2x2() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([[1, 2], [3, 4]]);
        $this->assertEqualsWithDelta(-2, $resultado, 0.000001);
    }

    public function testDeterminante3x3() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([[2, -1, 0], [-1, 2, -1], [0, -1, 2]]);
        $this->assertEqualsWithDelta(4, $resultado, 0.000001);
    }

    public function testDeterminante4x4Triangular() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([
            [2, 1, 1, 1],
            [0, 3, 1, 1],
            [0, 0, 4, 1],
            [0, 0, 0, 5]
        ]);
        $this->assertEqualsWithDelta(120, $resultado, 0.000001);
    }

    public function testDeterminanteDaIdentidade() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([[1, 0, 0], [0, 1, 0], [0, 0, 1]]);
        $this->assertEqualsWithDelta(1, $resultado, 0.000001);
    }

    public function testDeterminanteDaMatrizNula() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([[0, 0], [0, 0]]);
        $this->assertEqualsWithDelta(0, $resultado, 0.000001);
    }

    public function testTrocaDeLinhasInverteOSinal() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([[0, 1], [1, 0]]);
        $this->assertEqualsWithDelta(-1, $resultado, 0.000001);
    }

    public function testDeterminanteComPontoFlutuante() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([[0.1, 0.2], [0.3, 0.4]]);
        $this->assertEqualsWithDelta(-0.02, $resultado, 0.000001);
    }

    public function testMatrizNaoQuadrada() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([[1, 2, 3], [4, 5, 6]]);
        $this->assertEquals("A matriz deve ser quadrada", $resultado);
    }

    public function testMatrizVazia() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->calcular([]);
        $this->assertEquals("Matriz vazia", $resultado);
    }

    public function testMatrizSingularComLinhasProporcionais() {
        $calculadora = new DeterminanteCalculator();
        $this->assertTrue($calculadora->ehSingular([[1, 2], [2, 4]]));
    }

    public function testMatrizSingular3x3() {
        $calculadora = new DeterminanteCalculator();
        $this->assertTrue($calculadora->ehSingular([[1, 2, 3], [4, 5, 6], [7, 8, 9]]));
    }

    public function testMatrizNulaESingular() {
        $calculadora = new DeterminanteCalculator();
        $this->assertTrue($calculadora->ehSingular([[0, 0], [0, 0]]));
    }

    public function testMatriz1x1ZeroESingular() {
        $calculadora = new DeterminanteCalculator();
        $this->assertTrue($calculadora->ehSingular([[0]]));
    }

    public function testMatrizNaoSingular() {
        $calculadora = new DeterminanteCalculator();
        $this->assertFalse($calculadora->ehSingular([[1, 2], [3, 4]]));
    }

    public function testIdentidadeNaoESingular() {
        $calculadora = new DeterminanteCalculator();
        $this->assertFalse($calculadora->ehSingular([[1, 0], [0, 1]]));
    }

    public function testSingularidadeExigeMatrizQuadrada() {
        $calculadora = new DeterminanteCalculator();
        $resultado = $calculadora->ehSingular([[1, 2]]);
        $this->assertEquals("A matriz deve ser quadrada", $resultado);
    }
}
