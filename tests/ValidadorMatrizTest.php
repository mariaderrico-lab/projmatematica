<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Calculos/ValidadorMatriz.php';

class ValidadorMatrizTest extends TestCase
{
    public function testMatrizValida() {
        $validador = new ValidadorMatriz();
        $this->assertNull($validador->validar([[1, 2], [3, 4]]));
    }

    public function testMatriz1x1Valida() {
        $validador = new ValidadorMatriz();
        $this->assertNull($validador->validar([[7]]));
    }

    public function testMatrizVazia() {
        $validador = new ValidadorMatriz();
        $this->assertEquals("Matriz vazia", $validador->validar([]));
    }

    public function testLinhaVazia() {
        $validador = new ValidadorMatriz();
        $this->assertEquals(
            "Matriz inválida: cada linha deve ter ao menos um valor",
            $validador->validar([[]])
        );
    }

    public function testLinhaQueNaoEUmArray() {
        $validador = new ValidadorMatriz();
        $this->assertEquals(
            "Matriz inválida: cada linha deve ter ao menos um valor",
            $validador->validar([1, 2])
        );
    }

    public function testMatrizIrregular() {
        $validador = new ValidadorMatriz();
        $this->assertEquals(
            "Matriz irregular: todas as linhas devem ter o mesmo número de colunas",
            $validador->validar([[1, 2], [3]])
        );
    }

    public function testMatrizComTexto() {
        $validador = new ValidadorMatriz();
        $this->assertEquals(
            "A matriz deve conter apenas valores numéricos",
            $validador->validar([[1, "abc"]])
        );
    }

    public function testMatrizComInfinito() {
        $validador = new ValidadorMatriz();
        $this->assertEquals(
            "A matriz deve conter apenas valores numéricos",
            $validador->validar([[INF]])
        );
    }

    public function testVetorValido() {
        $validador = new ValidadorMatriz();
        $this->assertNull($validador->validarVetor([1, 2.5, "3"]));
    }

    public function testVetorVazio() {
        $validador = new ValidadorMatriz();
        $this->assertEquals("Vetor vazio", $validador->validarVetor([]));
    }

    public function testVetorComTexto() {
        $validador = new ValidadorMatriz();
        $this->assertEquals(
            "O vetor deve conter apenas valores numéricos",
            $validador->validarVetor([1, "x"])
        );
    }
}
