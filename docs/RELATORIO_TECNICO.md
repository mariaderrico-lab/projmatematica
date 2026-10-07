Relatório Técnico e Planejamento de Testes — Laboratório de Álgebra Linear
1. Objetivo
Os testes têm como objetivo verificar o funcionamento correto dos algoritmos de Álgebra Linear desenvolvidos em PHP, garantindo resultados matematicamente corretos e tratamento adequado de erros.

Serão utilizados PHPUnit, Composer, Laravel Herd, PHP 8.4 e Windows.

2. Escopo dos testes
Serão testadas as seguintes funcionalidades:

Soma de matrizes;
Multiplicação de matrizes;
Transposição;
Determinante;
Identificação de matrizes singulares;
Resolução de sistemas lineares;
Validação de matrizes e vetores;
Conversão de texto para matrizes e vetores;
Interface web.
Serão considerados casos normais, casos de borda e casos de erro.

3. Lógica dos algoritmos
Soma
Valida as matrizes e verifica se possuem as mesmas dimensões. Depois, soma os elementos correspondentes.
Caso as dimensões sejam incompatíveis, retorna:
Dimensões incompatíveis para soma

Multiplicação
Verifica se o número de colunas da primeira matriz é igual ao número de linhas da segunda. Utiliza três laços para calcular o produto das matrizes.

Transposição
Transforma linhas em colunas utilizando:
T[j][i] = M[i][j]

Determinante
Utiliza eliminação de Gauss com pivoteamento parcial, permitindo calcular o determinante de matrizes quadradas com maior estabilidade numérica.

É utilizado:
EPSILON = 1e-10
para considerar valores muito próximos de zero como zero.

Matriz singular
Uma matriz é considerada singular quando:

|det(A)| < EPSILON

Sistemas lineares
Utiliza o método de Gauss-Jordan para classificar e resolver sistemas.

Os sistemas podem ser:
Determinado: possui uma única solução;
Impossível: não possui solução;
Indeterminado: possui infinitas soluções.

4. Decisões de design
O projeto foi organizado separando as responsabilidades:

Calculos/
Controller/
Model/
View/

As matrizes são representadas como arrays de arrays do PHP:

[
    [1, 2],
    [3, 4]
]

Foi criado um ValidadorMatriz compartilhado para evitar repetição de código.
A classe ConversorMatriz transforma os dados digitados pelo usuário em matrizes e vetores, aceitando também vírgula decimal.
Os erros são tratados por mensagens de texto e os resultados numéricos utilizam tolerância para evitar problemas de ponto flutuante.

5. Abordagem dos testes
Os testes serão divididos em:

Casos felizes
Entradas válidas com resultados conhecidos.
Exemplo:

[[1,2],[3,4]] + [[5,6],[7,8]]

Resultado:
[[6,8],[10,12]]

Casos de borda
Serão testados:
Matrizes 1x1;
Matriz identidade;
Matriz nula;

Números negativos;
Números decimais;
Sistemas com uma incógnita;

Matrizes vazias.

Casos de erro
Serão testados:
Matrizes incompatíveis;
Matrizes irregulares;
Valores não numéricos;
Determinante de matriz não quadrada;
Sistemas impossíveis;
Sistemas indeterminados;
Vetores com tamanho incorreto.

6. Principais casos de teste
ID	Teste	Resultado esperado
CT01	Soma de matrizes 2x2	Resultado correto
CT02	Soma com dimensões diferentes	Mensagem de erro
CT03	Multiplicação 2x2	Resultado correto
CT04	Multiplicação incompatível	Mensagem de erro
CT05	Transposição 2x3	Matriz transposta corretamente
CT06	Determinante 2x2	Valor correto
CT07	Determinante de identidade	1
CT08	Matriz singular	true
CT09	Matriz não singular	false
CT10	Sistema determinado	Solução correta
CT11	Sistema impossível	"Sistema impossível"
CT12	Sistema indeterminado	"Sistema possível e indeterminado"
CT13	Conversão de texto	Array correto
CT14	Valor inválido	Mensagem de erro
CT15	Entrada inválida na interface	Mensagem de erro

7. Precisão numérica
Como os cálculos utilizam números de ponto flutuante, podem ocorrer pequenas diferenças, como no caso de:

0.1 + 0.2

Por isso, os testes utilizam:

assertEqualsWithDelta()

com tolerância de:
0.000001
Para decisões internas dos algoritmos é utilizado:
EPSILON = 1e-10

8. Dificuldades encontradas
As principais dificuldades foram:

Tratamento de erros de ponto flutuante;
Identificação de matrizes singulares;
Necessidade de pivoteamento quando o pivô é zero;
Diferenciação entre sistemas impossíveis e indeterminados;
Configuração do PHP e das extensões necessárias para o Composer e PHPUnit;
Configuração do ambiente utilizando Laravel Herd.
Após a configuração do PHP, as extensões necessárias, como openssl, mbstring e curl, foram habilitadas.

9. Critérios de aprovação
Os testes serão considerados aprovados quando:
Os cálculos apresentarem resultados corretos;
Operações incompatíveis forem rejeitadas;
Sistemas sejam classificados corretamente;
Entradas inválidas apresentem mensagens adequadas;
Casos de borda sejam tratados corretamente;
Os testes automatizados sejam executados sem falhas;
A cobertura dos algoritmos seja de pelo menos 80%.

10. Conclusão
Os testes automatizados com PHPUnit, juntamente com os testes manuais da interface, permitem verificar tanto aoteamento e tolerância numérica contribui para tornar os cálculos mais confiáveis. O objetivo correção dos algoritmos matemáticos quanto o comportamento da aplicação diante de entradas inválidas.

A utilização de validação, pivoteamento e tolerância numérica contribui para tornar os cálculos mais confiáveis. O objetivo final é garantir uma aplicação estável, correta e com cobertura mínima de 80% nos algoritmos.


