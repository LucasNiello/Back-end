<?php
require_once __DIR__ . '/../Model/Emprestimo.php';
require_once __DIR__ . '/../Model/EmprestimoDAO.php';
require_once __DIR__ . '/../Model/LivroDAO.php';

class EmprestimoController {
    private $emprestimoDAO;
    private $livroDAO;

    public function __construct() {
        $this->emprestimoDAO = new EmprestimoDAO();
        $this->livroDAO = new LivroDAO(); 
    }

    public function index() {
        $livrosDisponiveis = $this->livroDAO->lerLivros();
        $emprestimosPendentes = $this->emprestimoDAO->listarEmprestimosPendentes();
        
        require_once __DIR__ . '/../View/emprestimos.php';
    }

    public function emprestar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $livroId = (int)$_POST['livro_id'];
                $usuarioNome = $_POST['usuario_nome'];
                $dataPrevista = $_POST['data_prevista_devolucao'];

                $livro = $this->livroDAO->buscarPorId($livroId);
                if (!$livro || $livro->getQuantidade() <= 0) {
                    $_SESSION['feedback'] = "Erro: O livro **{$livro->getTitulo()}** não está disponível em estoque.";
                    header('Location: index.php?controller=emprestimo');
                    exit;
                }

                $emprestimo = new Emprestimo();
                $emprestimo->setLivroId($livroId);
                $emprestimo->setUsuarioNome($usuarioNome);
                $emprestimo->setDataEmprestimo(date('Y-m-d')); 
                $emprestimo->setDataPrevistaDevolucao($dataPrevista);

                $this->emprestimoDAO->realizarEmprestimo($emprestimo);

                $_SESSION['feedback'] = "Empréstimo do livro **{$livro->getTitulo()}** para {$usuarioNome} realizado com sucesso!";
            } catch (Exception $e) {
                $_SESSION['feedback'] = "Erro ao realizar empréstimo: " . $e->getMessage();
            }
        }
        header('Location: index.php?controller=emprestimo');
        exit;
    }

    public function devolver($emprestimoId, $livroId) {
        try {
            $this->emprestimoDAO->registrarDevolucao($emprestimoId, $livroId);
            
            $_SESSION['feedback'] = "Devolução registrada com sucesso! Estoque atualizado.";
        } catch (Exception $e) {
            $_SESSION['feedback'] = "Erro ao registrar devolução: " . $e->getMessage();
        }
        header('Location: index.php?controller=emprestimo');
        exit;
    }
}