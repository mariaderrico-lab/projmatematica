<?php

require_once __DIR__ . '/../Controller/MatrizController.php';

$controller = new MatrizController();

$resultado = $controller->calcular();
$operacoes = $controller->operacoes();

function h(string $texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function formatar(float|int $numero)
{
    $texto = rtrim(rtrim(number_format((float) $numero, 6, '.', ''), '0'), '.');

    if ($texto === '' || $texto === '-0') {
        return '0';
    }

    return $texto;
}

$operacaoAtual = $_POST['operacao'] ?? 'soma';
$matrizA = $_POST['matrizA'] ?? "1 2\n3 4";
$matrizB = $_POST['matrizB'] ?? "5 6\n7 8";
$termos = $_POST['termos'] ?? "5 1";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laboratório de Álgebra Linear</title>

    <link rel="stylesheet" href="../templates/style.css">
</head>

<body>

    <header class="cabecalho">
        <div class="container">
            <h1>Laboratório de Álgebra Linear</h1>
            <p>Operações com matrizes e resolução de sistemas lineares</p>
        </div>
    </header>

    <main class="container">

        <section class="introducao">
            <h2>Calculadora de Matrizes</h2>

            <p>
                Escolha a operação e digite as matrizes, uma linha por linha,
                com os valores separados por espaço.
            </p>
        </section>

        <section class="card">

            <h2>Dados da operação</h2>

            <form action="" method="POST">

                <div class="campo">
                    <label for="operacao">Operação</label>
                    <select id="operacao" name="operacao" onchange="atualizarCampos()">
                        <?php foreach ($operacoes as $chave => $rotulo): ?>
                            <option value="<?= h($chave) ?>" <?= $operacaoAtual === $chave ? 'selected' : '' ?>>
                                <?= h($rotulo) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="matrizA">Matriz A</label>
                    <textarea id="matrizA" name="matrizA" rows="5" required><?= h($matrizA) ?></textarea>
                    <small>Exemplo: "1 2" na primeira linha e "3 4" na segunda.</small>
                </div>

                <div class="campo" id="campoB">
                    <label for="matrizB">Matriz B</label>
                    <textarea id="matrizB" name="matrizB" rows="5"><?= h($matrizB) ?></textarea>
                    <small>Usada na soma e na multiplicação.</small>
                </div>

                <div class="campo" id="campoTermos">
                    <label for="termos">Termos independentes (vetor b)</label>
                    <input type="text" id="termos" name="termos" value="<?= h($termos) ?>" placeholder="Ex.: 5 1">
                    <small>Um valor por equação, separados por espaço.</small>
                </div>

                <button type="submit">
                    Calcular
                </button>

            </form>

    <?php if ($resultado !== null): ?>

    <div class="resultado <?= $resultado["tipo"] === "erro" ? "erro" : "" ?>">

        <h2><?= h($resultado["operacao"]) ?></h2>

        <?php if ($resultado["classificacao"] !== null): ?>
            <p><strong><?= h($resultado["classificacao"]) ?></strong></p>
        <?php endif; ?>

        <?php if ($resultado["tipo"] === "erro" || $resultado["tipo"] === "texto"): ?>

            <p><?= h($resultado["valor"]) ?></p>

        <?php elseif ($resultado["tipo"] === "numero"): ?>

            <p class="numero"><?= h(formatar($resultado["valor"])) ?></p>

        <?php elseif ($resultado["tipo"] === "vetor"): ?>

            <?php foreach ($resultado["valor"] as $i => $x): ?>
                <p><strong>x<?= $i + 1 ?></strong> = <?= h(formatar($x)) ?></p>
            <?php endforeach; ?>

        <?php elseif ($resultado["tipo"] === "matriz"): ?>

            <table class="tabela-matriz">
                <?php foreach ($resultado["valor"] as $linha): ?>
                    <tr>
                        <?php foreach ($linha as $valor): ?>
                            <td><?= h(formatar($valor)) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php endif; ?>

    </div>

    <?php endif; ?>

        </section>

        <section class="informacoes">

            <h2>Algoritmos implementados</h2>

            <div class="parametros">

                <div class="parametro">
                    <h3>Soma e multiplicação</h3>
                    <p>
                        Operam sobre matrizes de dimensões compatíveis e
                        informam quando a operação é impossível.
                    </p>
                </div>

                <div class="parametro">
                    <h3>Transposição</h3>
                    <p>
                        Troca linhas por colunas da matriz informada.
                    </p>
                </div>

                <div class="parametro">
                    <h3>Determinante</h3>
                    <p>
                        Calculado por eliminação gaussiana com pivoteamento parcial.
                    </p>
                </div>

                <div class="parametro">
                    <h3>Matriz singular</h3>
                    <p>
                        Uma matriz é singular quando seu determinante é zero.
                    </p>
                </div>

                <div class="parametro">
                    <h3>Sistemas lineares</h3>
                    <p>
                        Resolve e classifica o sistema como determinado,
                        indeterminado ou impossível.
                    </p>
                </div>

            </div>

        </section>

    </main>

    <footer>
        <p>
            Laboratório Digital de Álgebra Linear
        </p>
    </footer>

    <script>
        function atualizarCampos() {
            var op = document.getElementById('operacao').value;
            document.getElementById('campoB').style.display =
                (op === 'soma' || op === 'multiplicacao') ? 'flex' : 'none';
            document.getElementById('campoTermos').style.display =
                (op === 'sistema') ? 'flex' : 'none';
        }
        atualizarCampos();
    </script>

</body>
</html>
