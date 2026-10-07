Laboratório de Álgebra Linear

Aplicação web desenvolvida em PHP para realizar operações de Álgebra Linear, como soma, multiplicação e transposição de matrizes, cálculo de determinantes e resolução de sistemas lineares.

O projeto utiliza PHPUnit para testar os algoritmos.

--

Estrutura

Calculos/      Algoritmos matemáticos
Controller/    Controle da aplicação
Model/         Classes de dados
View/          Interface
templates/     Estilos CSS
tests/         Testes PHPUnit
docs/          Documentação

Requisitos
PHP 8.4+
Composer
Laravel Herd
Git
PHPUnit

Instalação
git clone 
cd algebralinear
composer install

Coloque o projeto no diretório do Laravel Herd.

Acesse:

http://algebralinear.test

Operações disponíveis
Operação	Classe
Soma	SomaCalculator
Multiplicação	MultiplicacaoCalculator
Transposição	TransposicaoCalculator
Determinante	DeterminanteCalculator
Matriz singular	DeterminanteCalculator
Sistemas lineares	SistemaLinearCalculator

Testes
Os testes são realizados com PHPUnit.

Para executar:
vendor/bin/phpunit

No Windows:
vendor\bin\phpunit
Os testes verificam resultados corretos, entradas inválidas, casos de borda e erros matemáticos.

Cobertura
A meta mínima de cobertura é 80% da pasta Calculos/.

Com Xdebug habilitado:
set XDEBUG_MODE=coverage
vendor\bin\phpunit --coverage-html coverage --coverage-text
O relatório será criado em:
coverage/index.html

Documentação
A documentação está na pasta docs/:
RELATORIO_TECNICO.md — Relatório técnico

Tecnologias
PHP 8.4
PHPUnit
Composer
Laravel Herd
HTML/CSS
Git

Objetivo
Desenvolver uma aplicação simples para realizar operações de Álgebra Linear, garantindo a qualidade dos resultados por meio de testes automatizados.

---
Declaração de IA
Foram utilizadas ferramentas de Inteligência Artificial como apoio durante o desenvolvimento do projeto, 
principalmente para auxiliar na organização e melhoria do HTML e CSS, na estruturação do relatório técnico 
e README, além de ajudar na identificação e definição dos parâmetros e tipos de dados no código PHP. A IA 
foi utilizada como ferramenta de suporte, enquanto a implementação, testes e decisões finais foram 
realizadas pela dupla.
