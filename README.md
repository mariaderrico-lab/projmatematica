# Laboratório de Álgebra Linear

Aplicação web em PHP que implementa algoritmos de álgebra linear (operações com matrizes e sistemas lineares), validados por testes unitários com PHPUnit. Segue a mesma organização do projeto *Laboratório de Qualidade da Água* (Controller / Model / Calculos / View / templates / tests).

## Estrutura

```
Calculos/      algoritmos (uma classe por operação) + ValidadorMatriz e ConversorMatriz
Controller/    MatrizController: recebe o formulário e chama os cálculos
Model/         Matriz e SistemaLinear (classes de dados)
View/          index.php (interface web)
templates/     style.css
tests/         testes PHPUnit (um arquivo por classe de Calculos)
docs/          plano de testes (PT/EN) e relatório técnico
```

## Instalação e execução

Requisitos: PHP >= 8.4, Composer, Laravel Herd, Git.

```bash
git clone <url-do-repositorio> algebralinear
cd algebralinear
composer install
```

Coloque a pasta no diretório do Laravel Herd e acesse `http://algebralinear.test` (ou `http://algebralinear.test/View/index.php`).

## Algoritmos implementados

| Algoritmo | Classe | Método |
|---|---|---|
| Soma de matrizes | `SomaCalculator` | `somar($a, $b)` |
| Multiplicação de matrizes | `MultiplicacaoCalculator` | `multiplicar($a, $b)` |
| Transposição | `TransposicaoCalculator` | `transpor($matriz)` |
| Determinante (eliminação gaussiana com pivoteamento parcial) | `DeterminanteCalculator` | `calcular($matriz)` |
| Matriz singular | `DeterminanteCalculator` | `ehSingular($matriz)` |
| Sistemas lineares (Gauss-Jordan): determinado, indeterminado ou impossível | `SistemaLinearCalculator` | `resolver(...)` / `classificar(...)` |

Como no projeto modelo, os erros (dimensões incompatíveis, matriz vazia/irregular, valor não numérico, matriz não quadrada, sistema impossível/indeterminado) são devolvidos como **mensagem de texto**, e a interface as exibe ao usuário.

## Como rodar os testes

```bash
vendor/bin/phpunit
```

### Cobertura (mínimo exigido: 80% de `Calculos/`)

Requer Xdebug ou PCOV habilitado. No Prompt de Comando (Windows):

```bat
set XDEBUG_MODE=coverage
vendor\bin\phpunit --coverage-html coverage --coverage-text
```

O relatório HTML fica em `coverage/index.html`. **Inclua aqui os prints da execução e da cobertura.**

## Documentação

[Plano de testes (PT)](docs/PLANO_DE_TESTES.md) · [Test plan (EN)](docs/TEST_PLAN.en.md) · [Relatório técnico](docs/RELATORIO_TECNICO.md)
