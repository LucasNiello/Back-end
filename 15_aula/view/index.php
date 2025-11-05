<?php
// 15_aula/view/index.php

require_once("../controller/bebidaController.php");
$controller = new BebidaController();

// --- DEFINIÇÃO DE ESTADO ---
// Por padrão, não estamos em modo de edição
$modoEdicao = false;
$bebidaParaEditar = null;

// --- "ROTEADOR" DE AÇÕES ---

// 1. AÇÕES GET (Excluir ou Carregar para Editar)
if (isset($_GET['acao'])) {
    
    // AÇÃO: EXCLUIR
    if ($_GET['acao'] === 'excluir' && isset($_GET['id'])) {
        $idParaExcluir = $_GET['id'];
        $controller->excluirBebida($idParaExcluir);
        header("Location: index.php"); // Redireciona para limpar a URL
        exit;
    }
    
    // AÇÃO: CARREGAR PARA EDITAR
    if ($_GET['acao'] === 'editar' && isset($_GET['id'])) {
        $idParaEditar = $_GET['id'];
        $bebidaParaEditar = $controller->buscarBebidaPorId($idParaEditar);
        
        // Se encontramos a bebida, ativamos o modo de edição
        if ($bebidaParaEditar) {
            $modoEdicao = true;
        } else {
            // Se o ID for inválido, apenas volte para o index
            header("Location: index.php");
            exit;
        }
    }
}

// 2. AÇÕES POST (Adicionar ou Atualizar)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Verifica se é um UPDATE (terá um 'id' enviado pelo form)
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // AÇÃO: ATUALIZAR
        $controller->atualizarBebida(
            $_POST['id'],
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['volume'],
            floatval($_POST['valor']),
            intval($_POST['qtd'])
        );
    } else {
        // AÇÃO: ADICIONAR
        $controller->adicionarBebida(
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['volume'],
            floatval($_POST['valor']),
            intval($_POST['qtd'])
        );
    }
    
    // Após qualquer ação POST, redireciona para a home
    header("Location: index.php");
    exit;
}

// 3. CARREGAR A LISTA (Apenas se NÃO estivermos no modo de edição)
$lista = [];
if (!$modoEdicao) {
    $lista = $controller->listarBebidas();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Bebidas (JSON)</title>
    <style>
        /* Seus estilos base (corrigidos e sem duplicatas) */
        body { background: #111; color: #eee; font-family: Arial; text-align: center; }
        form { margin: 20px auto; background: #222; padding: 20px; width: 300px; border-radius: 8px; }
        input { width: 90%; margin: 5px; padding: 8px; border: none; border-radius: 5px; }
        button { background: crimson; color: white; border: none; padding: 8px 16px; border-radius: 5px; margin-top: 10px; cursor: pointer; }
        table { margin: 20px auto; border-collapse: collapse; width: 80%; }
        th, td { border-bottom: 1px solid #444; padding: 8px; }
        th { background: #333; }
        
        /* Estilo base para os links de ação */
        td.acoes a {
            text-decoration: none;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9em;
            margin: 0 2px;
        }
        
        /* Estilo para o botão de editar (azul) */
        td.acoes a.btn-editar {
            background: #007bff;
        }
        td.acoes a.btn-editar:hover {
            background: #0056b3;
        }
        
        /* Estilo para o botão de excluir (vermelho) */
        td.acoes a.btn-excluir {
            background: #a00;
        }
        td.acoes a.btn-excluir:hover {
            background: #c00;
        }

        /* (NOVO) Estilo para o botão de ATUALIZAR (azul) */
        button.btn-atualizar {
            background: #007bff;
        }
        button.btn-atualizar:hover {
            background: #0056b3;
        }

        /* (NOVO) Estilo para o link "Cancelar" */
        a.cancelar {
            display: inline-block;
            margin-top: 10px;
            color: #aaa;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1><?= $modoEdicao ? 'Editar Bebida' : 'Cadastro de Bebidas' ?></h1>

    <form method="POST">
        
        <?php if ($modoEdicao): ?>
            <input type="hidden" name="id" value="<?= $bebidaParaEditar->getId() ?>">
        <?php endif; ?>

        <input type="text" name="nome" placeholder="Nome" required 
               value="<?= $modoEdicao ? htmlspecialchars($bebidaParaEditar->getNome()) : '' ?>"><br>
        
        <input type="text" name="categoria" placeholder="Categoria" required 
               value="<?= $modoEdicao ? htmlspecialchars($bebidaParaEditar->getCategoria()) : '' ?>"><br>
        
        <input type="text" name="volume" placeholder="Volume (ml)" required 
               value="<?= $modoEdicao ? htmlspecialchars($bebidaParaEditar->getVolume()) : '' ?>"><br>
        
        <input type="number" step="0.01" name="valor" placeholder="Valor (R$)" required 
               value="<?= $modoEdicao ? $bebidaParaEditar->getValor() : '' ?>"><br>
        
        <input type="number" name="qtd" placeholder="Quantidade" required 
               value="<?= $modoEdicao ? $bebidaParaEditar->getQtd() : '' ?>"><br>
        
        <button type="submit" class="<?= $modoEdicao ? 'btn-atualizar' : '' ?>">
            <?= $modoEdicao ? 'Atualizar Bebida' : 'Adicionar Bebida' ?>
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
                        <a href="?acao=editar&id=<?= $b->getId() ?>" class="btn-editar">
                           Editar
                        </a>
                        <a href="?acao=excluir&id=<?= $b->getId() ?>" class="btn-excluir"
                           onclick="return confirm('Tem certeza que deseja excluir esta bebida?');">
                           Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <?php endif; // Fim do 'if (!$modoEdicao)' ?>

</body>
</html>