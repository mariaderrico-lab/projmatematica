<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Calculos/SistemaLinearCalculator.php';

class SistemaLinearCalculatorTest extends TestCase
{
    public function testSistemaDeterminado2x2() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[2, 1], [1, -1]], [5, 1]);
        $this->assertEqualsWithDelta([2, 1], $resultado, 0.000001);
    }

    public function testSistemaDeterminado3x3() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver(
            [[1, 1, 1], [0, 2, 5], [2, 5, -1]],
            [6, -4, 27]
        );
        $this->assertEqualsWithDelta([5, 3, -2], $resultado, 0.000001);
    }

    public function testSistemaQueExigePivoteamento() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[0, 1], [1, 0]], [3, 4]);
        $this->assertEqualsWithDelta([4, 3], $resultado, 0.000001);
    }

    public function testSistema1x1() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[2]], [4]);
        $this->assertEqualsWithDelta([2], $resultado, 0.000001);
    }

    public function testSistemaComMatrizIdentidade() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[1, 0], [0, 1]], [7, -8]);
        $this->assertEqualsWithDelta([7, -8], $resultado, 0.000001);
    }

    public function testSistemaComPontoFlutuante() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[0.1, 0.2], [1, -1]], [0.3, 0]);
        $this->assertEqualsWithDelta([1, 1], $resultado, 0.000001);
    }

    public function testSistemaSobredeterminadoConsistente() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[1, 1], [1, -1], [2, 1]], [3, 1, 5]);
        $this->assertEqualsWithDelta([2, 1], $resultado, 0.000001);
    }

    public function testClassificaSistemaDeterminado() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->classificar([[2, 1], [1, -1]], [5, 1]);
        $this->assertEquals("Sistema possível e determinado", $resultado);
    }

    public function testClassificaSistemaImpossivel() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->classificar([[1, 1], [1, 1]], [2, 3]);
        $this->assertEquals("Sistema impossível", $resultado);
    }

    public function testResolverSistemaImpossivel() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[1, 1], [1, 1]], [2, 3]);
        $this->assertEquals("Sistema impossível", $resultado);
    }

    public function testMatrizNulaComTermoNaoNuloEImpossivel() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->classificar([[0, 0], [0, 0]], [1, 0]);
        $this->assertEquals("Sistema impossível", $resultado);
    }

    public function testClassificaSistemaIndeterminado() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->classificar([[1, 1], [2, 2]], [2, 4]);
        $this->assertEquals("Sistema possível e indeterminado", $resultado);
    }

    public function testResolverSistemaIndeterminado() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[1, 1], [2, 2]], [2, 4]);
        $this->assertEquals("Sistema possível e indeterminado", $resultado);
    }

    public function testMatrizNulaComTermoNuloEIndeterminado() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->classificar([[0, 0], [0, 0]], [0, 0]);
        $this->assertEquals("Sistema possível e indeterminado", $resultado);
    }

    public function testMenosEquacoesQueIncognitas() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->classificar([[1, 1]], [1]);
        $this->assertEquals("Sistema possível e indeterminado", $resultado);
    }

    public function testVetorComTamanhoErrado() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[1, 0], [0, 1]], [1]);
        $this->assertEquals(
            "O vetor de termos deve ter o mesmo número de linhas da matriz",
            $resultado
        );
    }

    public function testVetorNaoNumerico() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->resolver([[1]], ["x"]);
        $this->assertEquals("O vetor deve conter apenas valores numéricos", $resultado);
    }

    public function testMatrizDeCoeficientesVazia() {
        $calculadora = new SistemaLinearCalculator();
        $resultado = $calculadora->classificar([], [1]);
        $this->assertEquals("Matriz vazia", $resultado);
    }
}
