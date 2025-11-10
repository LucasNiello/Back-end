<?php
// view/index.php

// 1. INICIALIZAÇÃO E CONTROLE
// !!! ATUALIZE O NOME DO ARQUIVO CONTROLLER !!!
require_once("../controller/seu_controller.php");
// !!! ATUALIZE O NOME DA CLASSE CONTROLLER !!!
$controller = new SEU_CONTROLLER_AQUI();

// 2. GERENCIAMENTO DE ESTADO
$modoEdicao = false; 
// !!! TROQUEI 'bebidaParaEditar' por 'itemParaEditar' !!!
$itemParaEditar = null; 

// 3. "ROTEADOR" DE AÇÕES

// 3.1. VERIFICA AÇÕES GET
if (isset($_GET['acao'])) {
    
    // AÇÃO: EXCLUIR
    if ($_GET['acao'] === 'excluir' && isset($_GET['id'])) {
        $idParaExcluir = $_GET['id'];
        $controller->excluirItem($idParaExcluir); // !!! MÉTODO ATUALIZADO !!!
        
        header("Location: index.php"); 
        exit; 
    }
    
    // AÇÃO: CARREGAR PARA EDITAR
    if ($_GET['acao'] === 'editar' && isset($_GET['id'])) {
        $idParaEditar = $_GET['id'];
        
        // !!! MÉTODO E VARIÁVEL ATUALIZADOS !!!
        $itemParaEditar = $controller->buscarItemPorId($idParaEditar);
        
        if ($itemParaEditar) {
            $modoEdicao = true;
        } else {
            header("Location: index.php");
            exit;
        }
    }
}

// 3.2. VERIFICA AÇÕES POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        
        // AÇÃO: ATUALIZAR (UPDATE)
        // !!! ATUALIZE O MÉTODO E OS CAMPOS VINDOS DO POST !!!
        $controller->atualizarItem(
            $_POST['id'], 
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['volume'],
            floatval($_POST['valor']),
            intval($_POST['qtd'])
        );
        
    } else {
        
        // AÇÃO: ADICIONAR (CREATE)
        // !!! ATUALIZE O MÉTODO E OS CAMPOS VINDOS DO POST !!!
        $controller->adicionarItem(
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['volume'],
            floatval($_POST['valor']),
            intval($_POST['qtd'])
        );
    }
    
    header("Location: index.php");
    exit;
}

// 4. CARREGAMENTO DE DADOS PARA A LISTA
$lista = [];
if (!$modoEdicao) {
    // !!! MÉTODO ATUALIZADO !!!
    $lista = $controller->listarItens();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Itens (JSON)</title>
    <style>
        /* ... Estilos (não precisa mexer) ... */
        body { background: #111; color: #eee; font-family: Arial; text-align: center; }
        form { margin: 20px auto; background: #222; padding: 20px; width: 300px; border-radius: 8px; }
        input { width: 90%; margin: 5px; padding: 8px; border: none; border-radius: 5px; }
        button { background: crimson; color: white; border: none; padding: 8px 16px; border-radius: 5px; margin-top: 10px; cursor: pointer; }
        table { margin: 20px auto; border-collapse: collapse; width: 80%; }
        th, td { border-bottom: 1px solid #444; padding: 8px; }
        th { background: #333; }
        td.acoes a { text-decoration: none; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.9em; margin: 0 2px; }
        td.acoes a.btn-editar { background: #007bff; }
        td.acoes a.btn-editar:hover { background: #0056b3; }
        td.acoes a.btn-excluir { background: #a00; }
        td.acoes a.btn-excluir:hover { background: #c00; }
        button.btn-atualizar { background: #007bff; }
        button.btn-atualizar:hover { background: #0056b3; }
        a.cancelar { display: inline-block; margin-top: 10px; color: #aaa; text-decoration: none; }
    </style>
</head>
<body>
    <h1><?= $modoEdicao ? 'Editar Item' : 'Cadastro de Itens' ?></h1>

    <form method="POST">
        
        <?php if ($modoEdicao): ?>
            <input type="hidden" name="id" value="<?= $itemParaEditar->getId() ?>">
        <?php endif; ?>

        <input type="text" name="nome" placeholder="Nome" required 
               value="<?= $modoEdicao ? htmlspecialchars($itemParaEditar->getNome()) : '' ?>"><br>
        
        <input type="text" name="categoria" placeholder="Categoria" required 
               value="<?= $modoEdicao ? htmlspecialchars($itemParaEditar->getCategoria()) : '' ?>"><br>
        
        <input type="text" name="volume" placeholder="Volume (ml)" required 
               value="<?= $modoEdicao ? htmlspecialchars($itemParaEditar->getVolume()) : '' ?>"><br>
        
        <input type="number" step="0.01" name="valor" placeholder="Valor (R$)" required 
               value="<?= $modoEdicao ? $itemParaEditar->getValor() : '' ?>"><br>
        
        <input type="number" name="qtd" placeholder="Quantidade" required 
               value="<?= $modoEdicao ? $itemParaEditar->getQtd() : '' ?>"><br>
        
        <button type="submit" class="<?= $modoEdicao ? 'btn-atualizar' : '' ?>">
            <?= $modoEdicao ? 'Atualizar Item' : 'Adicionar Item' ?>
        </button>
    </form>
    
    <?php if ($modoEdicao): ?>
        <a href="index.php" class="cancelar">Cancelar</a>
    <?php endif; ?>


    <?php if (!$modoEdicao): ?>
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
                <td colspan="6">Nenhum item cadastrado.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($lista as $item): ?> 
                <tr>
                    <td><?= htmlspecialchars($item->getNome()) ?></td>
                    <td><?= htmlspecialchars($item->getCategoria()) ?></td>
                    <td><?= htmlspecialchars($item->getVolume()) ?></td>
                    <td>R$ <?= number_format($item->getValor(), 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($item->getQtd()) ?></td>
                    <td class="acoes">
                        <a href="?acao=editar&id=<?= $item->getId() ?>" class="btn-editar">
                            Editar
                        </a>
                        <a href="?acao=excluir&id=<?= $item->getId() ?>" class="btn-excluir"
                           onclick="return confirm('Tem certeza que deseja excluir este item?');">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <?php endif; ?>

</body>
</html>