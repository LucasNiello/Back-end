<?php
// Carrega as classes Model (Entidade e Acesso a Dados)
require_once __DIR__ . '/../Model/Emprestimo.php';
require_once __DIR__ . '/../Model/EmprestimoDAO.php';
require_once __DIR__ . '/../Model/LivroDAO.php';

/**
 * EmprestimoController
 * Responsável por toda a lógica de negócio de empréstimos e devoluções.
 * Ele intermedia a View (interface) e os DAOs (acesso ao banco).
 */
class EmprestimoController {
    private $emprestimoDAO; // Objeto para interagir com a tabela 'emprestimos'.
    private $livroDAO;      // Objeto para interagir com a tabela 'livros' (para checar estoque).

    public function __construct() {
        // Inicializa os DAOs, preparando a classe para acessar o banco.
        $this->emprestimoDAO = new EmprestimoDAO();
        $this->livroDAO = new LivroDAO(); 
    }

    /**
     * Exibe a página principal de empréstimos.
     * Prepara os dados necessários para a View.
     */
    public function index() {
        // Busca todos os livros disponíveis para o formulário de empréstimo (SELECT)
        $livrosDisponiveis = $this->livroDAO->lerLivros();
        // Busca todos os empréstimos ainda não devolvidos (SELECT)
        $emprestimosPendentes = $this->emprestimoDAO->listarEmprestimosPendentes();
        
        // Inclui a View, passando as variáveis acima para serem exibidas.
        require_once __DIR__ . '/../View/emprestimos.php';
    }

    /**
     * Processa a requisição de empréstimo (ação de salvar).
     * Requer o método POST.
     */
    public function emprestar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Captura e sanitiza os dados do formulário
                $livroId = (int)$_POST['livro_id'];
                $usuarioNome = $_POST['usuario_nome'];
                $dataPrevista = $_POST['data_prevista_devolucao'];

                // 1. Lógica de Negócio: Checa o estoque antes de emprestar
                $livro = $this->livroDAO->buscarPorId($livroId);
                if (!$livro || $livro->getQuantidade() <= 0) {
                    // Feedback de erro e redirecionamento se o estoque for insuficiente.
                    $_SESSION['feedback'] = "Erro: O livro **{$livro->getTitulo()}** não está disponível em estoque.";
                    header('Location: index.php?controller=emprestimo');
                    exit;
                }

                // Cria o objeto Emprestimo e define seus atributos
                $emprestimo = new Emprestimo();
                $emprestimo->setLivroId($livroId);
                $emprestimo->setUsuarioNome($usuarioNome);
                $emprestimo->setDataEmprestimo(date('Y-m-d')); // Data atual
                $emprestimo->setDataPrevistaDevolucao($dataPrevista);

                // 2. Ação no Banco: Registra o empréstimo e decrementa o estoque.
                $this->emprestimoDAO->realizarEmprestimo($emprestimo);

                // Feedback de sucesso para a sessão
                $_SESSION['feedback'] = "Empréstimo do livro **{$livro->getTitulo()}** para {$usuarioNome} realizado com sucesso!";
            } catch (Exception $e) {
                // Captura qualquer erro de execução e salva na sessão.
                $_SESSION['feedback'] = "Erro ao realizar empréstimo: " . $e->getMessage();
            }
        }
        // Redireciona de volta para a página de empréstimos (padrão PRG - Post/Redirect/Get)
        header('Location: index.php?controller=emprestimo');
        exit;
    }

    /**
     * Processa a devolução de um empréstimo.
     * @param int $emprestimoId ID do empréstimo a ser devolvido.
     * @param int $livroId ID do livro para reabastecer o estoque.
     */
    public function devolver($emprestimoId, $livroId) {
        try {
            // 1. Ação no Banco: Registra a devolução e incrementa o estoque.
            $this->emprestimoDAO->registrarDevolucao($emprestimoId, $livroId);
            
            // Feedback de sucesso
            $_SESSION['feedback'] = "Devolução registrada com sucesso! Estoque atualizado.";
        } catch (Exception $e) {
            // Captura erro de execução
            $_SESSION['feedback'] = "Erro ao registrar devolução: " . $e->getMessage();
        }
        // Redireciona de volta para a lista de pendentes.
        header('Location: index.php?controller=emprestimo');
        exit;
    }
}