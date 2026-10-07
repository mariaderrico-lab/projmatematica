<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Calculos/ConversorMatriz.php';

class ConversorMatrizTest extends TestCase
{
    public function testConverteTextoEmMatriz() {
        $conversor = new ConversorMatriz();
        $resultado = $conversor->textoParaMatriz("1 2\n3 4\n");
        $this->assertEqualsWithDelta([[1, 2], [3, 4]], $resultado, 0.000001);
    }

    public function testAceitaVirgulaDecimalELinhasEmBranco() {
        $conversor = new ConversorMatriz();
        $resultado = $conversor->textoParaMatriz("\n1,5 2\r\n\n3 4\n");
        $this->assertEqualsWithDelta([[1.5, 2], [3, 4]], $resultado, 0.000001);
    }

    public function testTextoVazioParaMatriz() {
        $conversor = new ConversorMatriz();
        $this->assertEquals("Matriz vazia", $conversor->textoParaMatriz("  \n "));
    }

    public function testValorInvalidoNaMatriz() {
        $conversor = new ConversorMatriz();
        $this->assertEquals("Valor inválido: \"a\"", $conversor->textoParaMatriz("1 a"));
    }

    public function testConverteTextoEmVetor() {
        $conversor = new ConversorMatriz();
        $resultado = $conversor->textoParaVetor(" 1  -2.5 3 ");
        $this->assertEqualsWithDelta([1, -2.5, 3], $resultado, 0.000001);
    }

    public function testTextoVazioParaVetor() {
        $conversor = new ConversorMatriz();
        $this->assertEquals("Vetor vazio", $conversor->textoParaVetor(""));
    }

    public function testValorInvalidoNoVetor() {
        $conversor = new ConversorMatriz();
        $this->assertEquals("Valor inválido: \"x\"", $conversor->textoParaVetor("1 x"));
    }
}
