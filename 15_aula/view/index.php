<?php
// Caminho do arquivo: 15_aula/view/index.php
// Esta é a ÚNICA página visível para o usuário. 
// Ela é responsável por exibir o formulário, listar os dados e
// gerenciar todas as ações de Adicionar, Editar, Atualizar e Excluir (CRUD).
// Usamos um padrão de design chamado "Front Controller" (Controlador Frontal),
// onde uma única página decide o que fazer com base nos parâmetros da URL (GET) ou envios de formulário (POST).


// =================================================================
// 1. INICIALIZAÇÃO E CONTROLE
// =================================================================

// Incluímos o "cérebro" da nossa aplicação, o Controller.
// É o Controller que sabe como se comunicar com o Model (DAO) para manipular os dados (neste caso, o arquivo JSON).
require_once("../controller/bebidaController.php");

// Criamos uma 'instância' (um objeto) do controller para podermos chamar suas funções (métodos).
$controller = new BebidaController();


// =================================================================
// 2. GERENCIAMENTO DE ESTADO
// =================================================================

// Esta página agora tem dois "modos" ou "estados" principais: 'listar' e 'editar'.
// Estas variáveis PHP vão controlar qual modo está ativo e, consequentemente,
// o que o HTML lá embaixo vai desenhar na tela.

// Por padrão, a página sempre começa em modo de listagem (mostrando a tabela).
$modoEdicao = false; 

// Esta variável guardará a bebida específica que queremos editar.
// Ela começa como 'null' e só será preenchida se o usuário clicar em "Editar"
// (veja a Seção 3.1).
$bebidaParaEditar = null; 


// =================================================================
// 3. "ROTEADOR" DE AÇÕES
// =================================================================

// Esta é a parte lógica mais importante da página. 
// Ela verifica a URL (usando $_GET) e os envios de formulário (usando $_POST)
// para decidir qual ação o Controller deve tomar ANTES de desenhar o HTML.

// ---
// 3.1. VERIFICA AÇÕES GET (ações que vêm pela URL)
// ---
// A superglobal $_GET contém todos os parâmetros passados na URL.
// Ex: index.php?acao=excluir&id=123
// $_GET['acao'] seria 'excluir'
// $_GET['id'] seria '123'
if (isset($_GET['acao'])) {
    
    // ----------------------
    // AÇÃO: EXCLUIR
    // ----------------------
    // Se a URL for "...?acao=excluir&id=..."
    if ($_GET['acao'] === 'excluir' && isset($_GET['id'])) {
        $idParaExcluir = $_GET['id'];
        
        // Manda o Controller fazer o trabalho de exclusão
        $controller->excluirBebida($idParaExcluir);
        
        // !! IMPORTANTE: Redirecionamento (Padrão PRG - Post-Redirect-Get)
        // Nós redirecionamos de volta para 'index.php' limpo (sem o "?acao=excluir...").
        // Isso evita que o usuário re-exclua o item se ele atualizar a página (F5).
        header("Location: index.php"); 
        
        // !! FUNDAMENTAL: Encerra o script imediatamente após o redirecionamento.
        // Se não usarmos 'exit', o PHP continuaria executando e tentaria desenhar
        // o HTML abaixo, o que é desnecessário e pode causar erros.
        exit; 
    }
    
    // ----------------------
    // AÇÃO: CARREGAR PARA EDITAR
    // ----------------------
    // Se a URL for "...?acao=editar&id=..."
    if ($_GET['acao'] === 'editar' && isset($_GET['id'])) {
        $idParaEditar = $_GET['id'];
        
        // Pede ao controller para buscar a bebida específica no JSON.
        $bebidaParaEditar = $controller->buscarBebidaPorId($idParaEditar);
        
        if ($bebidaParaEditar) {
            // Se a bebida foi ENCONTRADA...
            // !! MUDANÇA DE ESTADO: Ativamos o "Modo Edição".
            // Agora, a variável $modoEdicao é 'true'.
            // O HTML lá embaixo usará isso para mostrar o formulário preenchido.
            $modoEdicao = true;
        } else {
            // Se o ID for inválido (não encontrou a bebida)...
            // Apenas redireciona para a home, ignorando a ação.
            header("Location: index.php");
            exit;
        }
    }
} // Fim da verificação de $_GET['acao']


// ---
// 3.2. VERIFICA AÇÕES POST (ações que vêm do formulário)
// ---
// $_SERVER["REQUEST_METHOD"] é a forma mais robusta de verificar o método HTTP.
// Se for "POST", significa que o usuário clicou no botão "submit" do nosso formulário.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Como sabemos se o usuário está "Adicionando" um novo ou "Atualizando" um existente?
    // Pelo campo escondido 'id'! 
    // Se o formulário enviou um campo 'id' (e ele não está vazio), é uma atualização.
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        
        // ----------------------
        // AÇÃO: ATUALIZAR (UPDATE)
        // ----------------------
        // $_POST é a superglobal que coleta os dados do formulário (method="POST").
        // Ela é um array associativo onde a chave é o atributo 'name' do <input>.
        $controller->atualizarBebida(
            $_POST['id'], // O ID da bebida que estamos atualizando
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['volume'],
            floatval($_POST['valor']), // Converte o texto (string) para float (número decimal)
            intval($_POST['qtd'])      // Converte o texto (string) para int (número inteiro)
        );
        
    } else {
        
        // ----------------------
        // AÇÃO: ADICIONAR (CREATE)
        // ----------------------
        // Se nenhum 'id' foi enviado no POST, é uma bebida nova.
        $controller->adicionarBebida(
            $_POST['nome'], // (FIX) Faltava o $_POST aqui no seu código original
            $_POST['categoria'],
            $_POST['volume'],
            floatval($_POST['valor']),
            intval($_POST['qtd'])
        );
    }
    
    // !! IMPORTANTE: Padrão "Post-Redirect-Get" (PRG).
    // Após CADA ação POST (seja Adicionar ou Atualizar), nós redirecionamos.
    // Isso previne o reenvio chato do formulário se o usuário atualizar a página (F5).
    // O navegador "esquece" a requisição POST e faz uma nova requisição GET limpa.
    header("Location: index.php");
    exit; // Encerra o script.
}


// =================================================================
// 4. CARREGAMENTO DE DADOS PARA A LISTA
// =================================================================

// Esta seção só é executada se nenhuma das ações anteriores (excluir, editar, adicionar, atualizar)
// tiver causado um 'exit'.

// Iniciamos a lista como um array vazio.
$lista = [];

// Otimização: A lista de bebidas só precisa ser carregada do JSON
// se NÃO estivermos no modo de edição. 
// Se $modoEdicao for 'true', pulamos essa busca, pois a tabela estará escondida.
if (!$modoEdicao) {
    $lista = $controller->listarBebidas();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <title><?= $modoEdicao ? 'Editar Bebida' : 'Gerenciador de Bebidas (JSON)' ?></title>
    
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
        button.btn-atualizar {
            background: #007bff;
        }
        button.btn-atualizar:hover {
            background: #0056b3;
        }

        /* (NOVO) Estilo para o link "Cancelar" que aparece no modo edição */
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
            <?php endforeach; // Fim do loop 'foreach' ?>
        <?php endif; // Fim do 'if (empty($lista))' ?>
    </table>
    <?php endif; // Fim do 'if (!$modoEdicao)' que esconde a tabela ?>

</body>
</html>