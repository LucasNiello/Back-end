<?php
// Inicia a sessão para permitir o uso de mensagens de feedback e persistência de dados temporários.
session_start();

// Carrega os Controladores responsáveis pela lógica de cada módulo.
require_once 'Controller/LivroController.php';
require_once 'Controller/EmprestimoController.php';

// Captura os parâmetros da URL. Se não existirem, define valores padrão ('livro' e 'index').
$controllerName = $_GET['controller'] ?? 'livro';
$action = $_GET['action'] ?? 'index';

try {
    // Roteamento: Verifica qual controlador foi solicitado.
    if ($controllerName === 'livro') {
        $controller = new LivroController();
        
        // Switch para decidir qual método (ação) do controlador executar.
        switch ($action) {
            case 'index': $controller->index(); break; // Listagem.
            case 'salvar': $controller->salvar(); break; // Cadastro.
            case 'editar': $controller->editar(intval($_GET['id'])); break; // Carrega formulário de edição.
            case 'atualizar': $controller->atualizar(); break; // Salva a edição.
            case 'excluir': $controller->excluir(intval($_GET['id'])); break; // Remove registro.
            case 'cancelar_edicao': unset($_SESSION['livro_edicao']); header('Location: index.php'); exit; // Limpa estado de edição.
            default: $controller->index(); break; // Ação padrão.
        }
    } elseif ($controllerName === 'emprestimo') {
        $controller = new EmprestimoController();
        
        // Switch para ações de empréstimo.
        switch ($action) {
            case 'index': $controller->index(); break; // Tela principal de empréstimos.
            case 'emprestar': $controller->emprestar(); break; // Processa novo empréstimo.
            case 'devolver': 
                // Captura IDs necessários para a devolução e converte para inteiro por segurança.
                $emprestimoId = intval($_GET['id']);
                $livroId = intval($_GET['livro_id']);
                $controller->devolver($emprestimoId, $livroId); 
                break;
            default: $controller->index(); break;
        }
    } else {
        // Fallback: Se o controlador informado na URL não existir, redireciona para o padrão.
        header('Location: index.php?controller=livro');
        exit;
    }
} catch (Exception $e) {
    // Tratamento Global de Erros: Captura qualquer falha não tratada nos controllers para não quebrar a tela.
    $_SESSION['feedback'] = "Erro Crítico no Sistema: " . $e->getMessage();
    header('Location: index.php?controller=' . $controllerName);
    exit;
}