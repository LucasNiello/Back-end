<?php
session_start();

require_once 'Controller/LivroController.php';
require_once 'Controller/EmprestimoController.php';

$controllerName = $_GET['controller'] ?? 'livro';
$action = $_GET['action'] ?? 'index';

try {
    if ($controllerName === 'livro') {
        $controller = new LivroController();
        switch ($action) {
            case 'index': $controller->index(); break;
            case 'salvar': $controller->salvar(); break;
            case 'editar': $controller->editar(intval($_GET['id'])); break;
            case 'atualizar': $controller->atualizar(); break;
            case 'excluir': $controller->excluir(intval($_GET['id'])); break;
            case 'cancelar_edicao': unset($_SESSION['livro_edicao']); header('Location: index.php'); exit;
            default: $controller->index(); break;
        }
    } elseif ($controllerName === 'emprestimo') {
        $controller = new EmprestimoController();
        switch ($action) {
            case 'index': $controller->index(); break;
            case 'emprestar': $controller->emprestar(); break;
            case 'devolver': 
                $emprestimoId = intval($_GET['id']);
                $livroId = intval($_GET['livro_id']);
                $controller->devolver($emprestimoId, $livroId); 
                break;
            default: $controller->index(); break;
        }
    } else {
        // Redireciona para o controller padrão se o nome for inválido
        header('Location: index.php?controller=livro');
        exit;
    }
} catch (Exception $e) {
    // Tratamento de exceção de baixo nível (fallback)
    $_SESSION['feedback'] = "Erro Crítico no Sistema: " . $e->getMessage();
    header('Location: index.php?controller=' . $controllerName);
    exit;
}