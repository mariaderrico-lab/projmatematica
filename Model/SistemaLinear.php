<?php

class SistemaLinear
{
    public $coeficientes;
    public $termos;
    public $classificacao;
    public $solucao;

    public function __construct(
        $coeficientes,
        $termos,
        $classificacao = null,
        $solucao = null
    ) {
        $this->coeficientes = $coeficientes;
        $this->termos = $termos;
        $this->classificacao = $classificacao;
        $this->solucao = $solucao;
    }
}
