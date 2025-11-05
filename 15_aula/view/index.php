<?php
// 15_aula/view/index.php

// 1. INICIALIZAÇÃO E CONTROLE
// Incluímos o "cérebro" da nossa aplicação, o Controller.
// É ele que sabe como se comunicar com o Model (DAO).
require_once("../controller/bebidaController.php");
$controller = new BebidaController();

// 2. GERENCIAMENTO DE ESTADO
// Esta página agora tem dois "modos": 'listar' e 'editar'.
// Estas variáveis controlam qual modo está ativo.

// Por padrão, a página sempre começa em modo de listagem.
$modoEdicao = false; 
// Esta variável guardará a bebida específica que queremos editar.
$bebidaParaEditar = null; 

// 3. "ROTEADOR" DE AÇÕES
// Esta é a parte mais importante. Ela verifica a URL (GET) e os envios de formulário (POST)
// para decidir qual ação o Controller deve tomar ANTES de desenhar o HTML.

// 3.1. VERIFICA AÇÕES GET (ações que vêm pela URL)
if (isset($_GET['acao'])) {
    
    // AÇÃO: EXCLUIR
    // Se a URL for "...?acao=excluir&id=..."
    if ($_GET['acao'] === 'excluir' && isset($_GET['id'])) {
        $idParaExcluir = $_GET['id'];
        $controller->excluirBebida($idParaExcluir);
        
        // IMPORTANTE: Redireciona de volta para 'index.php' limpo.
        // Isso remove o '?acao=excluir' da URL e evita re-excluir se o usuário atualizar a página (F5).
        header("Location: index.php"); 
        exit; // Encerra o script imediatamente após o redirecionamento.
    }
    
    // AÇÃO: CARREGAR PARA EDITAR
    // Se a URL for "...?acao=editar&id=..."
    if ($_GET['acao'] === 'editar' && isset($_GET['id'])) {
        $idParaEditar = $_GET['id'];
        // Pede ao controller para buscar a bebida específica no JSON.
        $bebidaParaEditar = $controller->buscarBebidaPorId($idParaEditar);
        
        if ($bebidaParaEditar) {
            // Se a bebida foi ENCONTRADA, ativamos o "Modo Edição".
            $modoEdicao = true;
        } else {
            // Se o ID for inválido (não encontrou), apenas redireciona para a home.
            header("Location: index.php");
            exit;
        }
    }
}

// 3.2. VERIFICA AÇÕES POST (ações que vêm do formulário)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Como sabemos se é um "Adicionar" ou "Atualizar"?
    // Pelo campo escondido 'id'! Se ele foi enviado junto com o POST, é uma atualização.
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        
        // AÇÃO: ATUALIZAR (UPDATE)
        $controller->atualizarBebida(
            $_POST['id'], // O ID da bebida que estamos atualizando
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['volume'],
            floatval($_POST['valor']),
            intval($_POST['qtd'])
        );
        
    } else {
        
        // AÇÃO: ADICIONAR (CREATE)
        // Se nenhum 'id' foi enviado, é uma bebida nova.
        $controller->adicionarBebida(
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['volume'],
            floatval($_POST['valor']),
            intval($_POST['qtd'])
        );
    }
    
    // IMPORTANTE: Padrão "Post-Redirect-Get" (PRG).
    // Após CADA ação POST (seja Adicionar ou Atualizar), nós redirecionamos.
    // Isso previne o reenvio chato do formulário se o usuário atualizar a página (F5).
    header("Location: index.php");
    exit;
}

// 4. CARREGAMENTO DE DADOS PARA A LISTA
// A lista de bebidas só precisa ser carregada do JSON
// se NÃO estivermos no modo de edição. Isso economiza processamento.
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
        /* ... Estilos base ... */
        body { background: #111; color: #eee; font-family: Arial; text-align: center; }
        form { margin: 20px auto; background: #222; padding: 20px; width: 300px; border-radius: 8px; }
        input { width: 90%; margin: 5px; padding: 8px; border: none; border-radius: 5px; }
        button { background: crimson; color: white; border: none; padding: 8px 16px; border-radius: 5px; margin-top: 10px; cursor: pointer; }
        table { margin: 20px auto; border-collapse: collapse; width: 80%; }
        th, td { border-bottom: 1px solid #444; padding: 8px; }
        th { background: #333; }
        
        /* Estilos dos botões de ação na tabela */
        td.acoes a {
            text-decoration: none;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9em;
            margin: 0 2px;
        }
        td.acoes a.btn-editar {
            background: #007bff;
        }
        td.acoes a.btn-editar:hover {
            background: #0056b3;
        }
        td.acoes a.btn-excluir {
            background: #a00;
        }
        td.acoes a.btn-excluir:hover {
            background: #c00;
        }

        /* (NOVO) Estilo para o botão de ATUALIZAR (azul) no formulário */
        /* Usamos 'button.btn-atualizar' para ser mais específico que o 'button' normal */
        button.btn-atualizar {
            background: #007bff;
        }
        button.btn-atualizar:hover {
            background: #0056b3;
        }

        /* (NOVO) Estilo para o link "Cancelar" que aparece no modo edição */
        a.cancelar {
            display: inline-block; /* Permite darmos margem */
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
    <?php endif; // Fim do 'if (!$modoEdicao)' que esconde a tabela ?>

</body>
</html>