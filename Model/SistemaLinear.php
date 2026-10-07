<?php

class SistemaLinear
{
    public array $coeficientes;
    public array $termos;
    public ?string $classificacao;
    public string|array|null $solucao;

    public function __construct(
       array  $coeficientes,
        array $termos,
        $classificacao = null,
        $solucao = null
    ) {
        $this->coeficientes = $coeficientes;
        $this->termos = $termos;
        $this->classificacao = $classificacao;
        $this->solucao = $solucao;
    }
}
