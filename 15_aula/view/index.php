<?php
// 15_aula/view/index.php

require_once("../controller/bebidaController.php");
$controller = new BebidaController();

// --- LÓGICA DE EXCLUSÃO (NOVO) ---
if (isset($_GET['acao']) && $_GET['acao'] === 'excluir' && isset($_GET['id'])) {
    
    $idParaExcluir = $_GET['id'];
    $controller->excluirBebida($idParaExcluir);
    
    header("Location: index.php");
    exit;
}

// --- LÓGICA DE ADIÇÃO (POST) ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller->adicionarBebida(
        $_POST['nome'],
        $_POST['categoria'],
        $_POST['volume'],
        floatval($_POST['valor']),
        intval($_POST['qtd'])
    );
    
    header("Location: index.php");
    exit;
}

$lista = $controller->listarBebidas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Bebidas (JSON)</title>
    <style>
        body { background: #111; color: #eee; font-family: Arial; text-align: center; }
        form { margin: 20px auto; background: #222; padding: 20px; width: 300px; border-radius: 8px; }
        input { width: 90%; margin: 5px; padding: 8px; border: none; border-radius: 5px; }
        button { background: crimson; color: white; border: none; padding: 8px 16px; border-radius: 5px; margin-top: 10px; cursor: pointer; }
        table { margin: 20px auto; border-collapse: collapse; width: 80%; }
        th, td { border-bottom: 1px solid #444; padding: 8px; }
        th { background: #333; }
        
        td.acoes a {
            text-decoration: none;
            background: #a00;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9em;
        }
        td.acoes a:hover {
            background: #c00;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Bebidas (MVC + JSON)</h1>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="text" name="categoria" placeholder="Categoria" required><br>
        <input type="text" name="volume" placeholder="Volume (ml)" required><br>
        <input type="number" step="0.01" name="valor" placeholder="Valor (R$)" required><br>
        <input type="number" name="qtd" placeholder="Quantidade" required><br>
        <button type="submit">Adicionar Bebida</button>
    </form>

    <table>
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Volume</th>
            <th>Valor</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>

        <?php if (empty($lista)): ?>
            <tr>
                <td colspan="6">Nenhuma bebida cadastrada.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($lista as $b): ?>
                <tr>
                    <td><?= htmlspecialchars($b->getNome()) ?></td>
                    <td><?= htmlspecialchars($b->getCategoria()) ?></td>
                    <td><?= htmlspecialchars($b->getVolume()) ?></td>
                    <td>R$ <?= number_format($b->getValor(), 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($b->getQtd()) ?></td>
                    
                    <td class="acoes">
                        <a href="?acao=excluir&id=<?= $b->getId() ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir esta bebida?');">
                           Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>