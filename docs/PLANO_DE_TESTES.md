# Relatório de Planejamento de Testes

## Definição do escopo
Os testes serão realizados na aplicação web desenvolvida em PHP, com o objetivo de verificar o funcionamento dos algoritmos de álgebra linear implementados no sistema. Serão desenvolvidos com o PHPUnit e terão como foco a camada responsável pelos algoritmos matemáticos (pasta `Calculos/`). Também serão considerados casos de entrada inválida e situações que impossibilitem determinadas operações. Os testes deverão verificar se os algoritmos produzem resultados matematicamente corretos e se os erros esperados são tratados adequadamente.

## O objetivo dos testes é garantir que
- As matrizes sejam corretamente representadas e processadas pela aplicação.
- A soma de matrizes seja correta para dimensões compatíveis e retorne mensagem de erro para dimensões incompatíveis.
- A multiplicação produza o resultado matematicamente correto e retorne erro para dimensões incompatíveis.
- A transposição seja realizada corretamente.
- O determinante seja correto para matrizes válidas, incluindo 1x1 e maiores.
- O algoritmo identifique corretamente uma matriz singular.
- A resolução de sistemas lineares produza soluções corretas para sistemas determinados.
- Sistemas impossíveis e indeterminados sejam identificados corretamente.
- Cálculos com ponto flutuante fiquem dentro de uma margem de precisão aceitável (`assertEqualsWithDelta`).
- Entradas inválidas e casos-limite sejam tratados adequadamente.
- A interface web permita inserir os dados e visualizar os resultados, com mensagens adequadas quando a operação não puder ser realizada.

## Abordagem dos testes
Os testes usam o PHPUnit, são automatizados e executados no Prompt de Comando. Há três tipos de cenário:
- **Casos felizes:** dados válidos e resultado esperado conhecido.
- **Casos de borda:** matrizes 1x1, identidade, nula e outros valores mínimos ou especiais.
- **Casos de erro:** dados inválidos ou operação matemática impossível.

## Os testes serão bem-sucedidos se
- As operações matemáticas produzirem os resultados esperados.
- A soma e a multiplicação de matrizes compatíveis forem calculadas corretamente.
- A aplicação impedir soma/multiplicação de matrizes com dimensões incompatíveis.
- Matrizes singulares forem identificadas corretamente.
- Sistemas determinados forem resolvidos corretamente.
- Entradas inválidas gerarem mensagens apropriadas.
- Matrizes 1x1, identidade e nulas forem processadas corretamente.
- Resultados decimais respeitarem a margem de precisão definida.
- Os testes automatizados forem executados sem falhas.
- A cobertura de código dos algoritmos for de pelo menos 80%.

## Os testes NÃO serão bem-sucedidos se
- Não aparecer mensagem de erro quando as informações forem digitadas incorretamente.
- Alguma operação matricial produzir resultado matematicamente incorreto.
- For permitida a soma ou multiplicação de matrizes incompatíveis.
- O determinante de uma matriz válida for calculado incorretamente.
- Uma matriz singular for tratada como não singular.
- Um sistema impossível for apresentado como tendo solução.
- Um sistema indeterminado for apresentado como tendo solução única.
- Os casos de borda não forem tratados corretamente.
- Os resultados decimais apresentarem erro superior à tolerância.
- Entradas inválidas provocarem comportamento inesperado.
- Os testes automatizados apresentarem falhas ou a cobertura ficar abaixo de 80%.

## Ambiente de teste
Ferramentas: Visual Studio Code, Composer, Laravel Herd. Sistema operacional: Windows. PHP >= 8.4.

## Casos de teste

| ID | Descrição | Cenário | Resultado esperado | Arquivo de teste |
|---|---|---|---|---|
| 1 | Soma | Matrizes 2x2 compatíveis `[[1,2],[3,4]] + [[5,6],[7,8]]` | `[[6,8],[10,12]]` | SomaCalculatorTest |
| 2 | Soma | 1x1, matriz nula, negativos, `0.1 + 0.2` | Resultado correto (delta 1e-6) | SomaCalculatorTest |
| 3 | Soma | `[[1,2]] + [[1],[2]]` | "Dimensões incompatíveis para soma" | SomaCalculatorTest |
| 4 | Soma | Matriz vazia / irregular / com texto | Mensagem de erro correspondente | SomaCalculatorTest |
| 5 | Multiplicação | 2x2 e 2x3 × 3x2 | `[[19,22],[43,50]]` e `[[58,64],[139,154]]` | MultiplicacaoCalculatorTest |
| 6 | Multiplicação | Identidade, nula, 1x1, decimais | Resultado correto | MultiplicacaoCalculatorTest |
| 7 | Multiplicação | `[[1,2]] × [[1,2]]` | "Dimensões incompatíveis para multiplicação" | MultiplicacaoCalculatorTest |
| 8 | Transposição | 2x3, 2x2, 1x1, identidade, dupla transposição | Resultado correto | TransposicaoCalculatorTest |
| 9 | Transposição | Matriz vazia / irregular | Mensagem de erro | TransposicaoCalculatorTest |
| 10 | Determinante | 1x1 (-4), 2x2 (-2), 3x3 (4), 4x4 triangular (120) | Valor correto | DeterminanteCalculatorTest |
| 11 | Determinante | Identidade (1), nula (0), troca de linhas (-1), decimais (-0,02) | Valor correto | DeterminanteCalculatorTest |
| 12 | Determinante | Matriz 2x3 | "A matriz deve ser quadrada" | DeterminanteCalculatorTest |
| 13 | Singular | `[[1,2],[2,4]]`, `[[1..9]]`, nula, `[[0]]` | `true` | DeterminanteCalculatorTest |
| 14 | Singular | `[[1,2],[3,4]]`, identidade | `false` | DeterminanteCalculatorTest |
| 15 | Sistema | `2x+y=5; x−y=1`; 3x3; pivoteamento; 1x1; identidade; decimais; sobredeterminado | Solução correta | SistemaLinearCalculatorTest |
| 16 | Sistema | `x+y=2; x+y=3`; matriz nula com b≠0 | "Sistema impossível" | SistemaLinearCalculatorTest |
| 17 | Sistema | `x+y=2; 2x+2y=4`; matriz nula com b=0; menos equações que incógnitas | "Sistema possível e indeterminado" | SistemaLinearCalculatorTest |
| 18 | Sistema | Vetor de tamanho errado / não numérico / matriz vazia | Mensagem de erro | SistemaLinearCalculatorTest |
| 19 | Validação | Matriz válida, 1x1, vazia, irregular, texto, infinito; vetor | `null` ou mensagem | ValidadorMatrizTest |
| 20 | Conversão | Texto → matriz/vetor, vírgula decimal, vazio, inválido | Array ou mensagem | ConversorMatrizTest |
| 21 | Interface web | Escolher operação, digitar dados e calcular; testar uma entrada inválida | Resultado ou mensagem de erro exibidos | Teste manual no Herd |
