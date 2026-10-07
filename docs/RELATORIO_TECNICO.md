# Relatório Técnico — Laboratório de Álgebra Linear

## 1. Lógica dos algoritmos

**Soma (`SomaCalculator`).** Valida as duas matrizes, confere se têm as mesmas dimensões e soma elemento a elemento. Dimensões diferentes retornam "Dimensões incompatíveis para soma".

**Multiplicação (`MultiplicacaoCalculator`).** Exige `colunas(A) = linhas(B)`. Cada `C[i][j]` é o produto escalar da linha *i* de A com a coluna *j* de B (três laços aninhados, O(m·n·p)).

**Transposição (`TransposicaoCalculator`).** `T[j][i] = M[i][j]`.

**Determinante (`DeterminanteCalculator::calcular`).** Eliminação gaussiana com pivoteamento parcial: em cada coluna escolhe-se o maior pivô em módulo, troca-se de linha se preciso (cada troca inverte o sinal), multiplica-se o determinante pelo pivô e zeram-se os elementos abaixo. Se o maior pivô é menor que `EPSILON = 1e-10`, a matriz é singular e o resultado é 0. Custo O(n³), contra O(n!) da expansão de Laplace.

**Matriz singular (`ehSingular`).** `|det(A)| < EPSILON`.

**Sistemas lineares (`SistemaLinearCalculator`).** Gauss-Jordan com pivoteamento parcial sobre a matriz aumentada `[A | b]`. Após a eliminação: uma linha `0 = c` com `c ≠ 0` indica **sistema impossível**; posto menor que o número de incógnitas indica **indeterminado**; caso contrário é **determinado** e a solução está na última coluna. Aceita também sistemas não quadrados. `classificar()` devolve o tipo do sistema e `resolver()` devolve o vetor solução ou a mensagem.

## 2. Decisões de design

- **Mesma arquitetura do projeto Laboratório de Qualidade da Água:** `Calculos/` com uma classe por algoritmo, `Controller/` para ligar formulário e cálculos, `Model/` para classes de dados e `View/` apenas para exibição.
- **Matrizes como arrays de arrays** (`[[1,2],[3,4]]`): estrutura nativa do PHP, simples de escrever nos testes e suficiente para o escopo.
- **Tratamento de erros por mensagem de texto**, como nas demais calculadoras do projeto modelo (`"Valor inválido"`, `"Valor inicial inválido"`). O resultado é `array`/`float`/`bool` quando há sucesso e `string` quando há erro; o Controller usa `is_string()` para decidir como exibir.
- **`ValidadorMatriz` compartilhado** por todas as calculadoras (matriz não vazia, retangular, numérica e finita), evitando repetição.
- **`ConversorMatriz`** transforma o texto digitado em arrays (aceita vírgula decimal), mantendo a View sem lógica.
- **Tolerância numérica única** (`EPSILON`) para decisões de "igual a zero"; nos testes, `assertEqualsWithDelta` com delta 0,000001.
- **Segurança:** toda saída na View passa por `htmlspecialchars`.

## 3. Dificuldades encontradas e soluções

- **Erros de ponto flutuante:** `0.1 + 0.2 !== 0.3`. Solução: `assertEqualsWithDelta` e arredondamento (`round`) dos resultados do determinante e da solução.
- **Detectar singularidade:** o determinante de `[[1,2,3],[4,5,6],[7,8,9]]` pode dar ~1e-16 em vez de 0. Solução: comparar com `EPSILON`.
- **Pivô zero:** `[[0,1],[1,0]]` falharia sem troca de linhas. Solução: pivoteamento parcial, com teste dedicado.
- **Diferenciar sistema impossível de indeterminado:** ambos têm posto deficiente; a diferença está no termo independente das linhas nulas após a eliminação.
- *(Acrescente aqui as dificuldades reais do grupo, como a instalação do Xdebug/PCOV no Herd.)*
