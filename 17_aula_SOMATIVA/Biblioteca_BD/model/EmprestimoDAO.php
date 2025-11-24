<?php
require_once __DIR__ . '/../config/Conexao.php'; // Inclui a classe de conexão Singleton.
require_once 'Emprestimo.php'; // Inclui a Entidade Emprestimo.
require_once 'LivroDAO.php'; // Inclui o DAO de Livro para manipular o estoque.

/**
 * EmprestimoDAO (Data Access Object)
 * Responsável pelas operações de CRUD e gerenciamento de transações no DB para empréstimos.
 */
class EmprestimoDAO {
    private $conexao;  // Objeto PDO da conexão ativa.
    private $livroDAO; // Instância de LivroDAO para gerenciar o estoque.

    public function __construct() {
        $this->conexao = Conexao::getConexao(); // Obtém a conexão PDO única (Singleton).
        $this->livroDAO = new LivroDAO();      // Inicializa o LivroDAO.
    }

    /**
     * Realiza um novo empréstimo e atualiza o estoque.
     * Esta operação usa Transação para garantir atomicidade.
     * @param Emprestimo $emprestimo
     */
    public function realizarEmprestimo(Emprestimo $emprestimo) {
        $this->conexao->beginTransaction(); // 🟢 Inicia a Transação: Marca o ponto de início.
        
        try {
            // 1. Diminui o estoque do livro (Operação externa via LivroDAO).
            $this->livroDAO->diminuirQuantidade($emprestimo->getLivroId());

            // 2. Registra o novo empréstimo.
            $sql = "INSERT INTO emprestimos (livro_id, usuario_nome, data_emprestimo, data_prevista_devolucao) 
                         VALUES (?, ?, ?, ?)";
            $stmt = $this->conexao->prepare($sql);

            // Bind dos valores para segurança (PreparedStatement).
            $stmt->bindValue(1, $emprestimo->getLivroId());
            $stmt->bindValue(2, $emprestimo->getUsuarioNome());
            $stmt->bindValue(3, $emprestimo->getDataEmprestimo());
            $stmt->bindValue(4, $emprestimo->getDataPrevistaDevolucao());
            $stmt->execute();

            $this->conexao->commit(); // ✅ Confirma: Salva TODAS as operações no banco.
            
        } catch (Exception $e) {
            $this->conexao->rollBack(); // ❌ Reverte: Desfaz TUDO (registro e estoque) se algo falhar.
            throw $e; // Propaga a exceção para ser tratada no Controller.
        }
    }

    /**
     * Registra a devolução e aumenta o estoque.
     * Esta operação também usa Transação.
     * @param int $emprestimoId ID do empréstimo.
     * @param int $livroId ID do livro relacionado.
     */
    public function registrarDevolucao($emprestimoId, $livroId) {
        $this->conexao->beginTransaction(); // 🟢 Inicia a Transação.
        
        try {
            // 1. Aumenta o estoque do livro (Operação externa via LivroDAO).
            $this->livroDAO->aumentarQuantidade($livroId);

            // 2. Atualiza a data de devolução no registro de empréstimo.
            $sql = "UPDATE emprestimos SET data_devolucao = NOW() WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $emprestimoId);
            $stmt->execute();

            $this->conexao->commit(); // ✅ Confirma: Salva a atualização e o estoque.
            
        } catch (Exception $e) {
            $this->conexao->rollBack(); // ❌ Reverte: Desfaz o aumento de estoque e a atualização.
            throw $e;
        }
    }

    /**
     * Retorna todos os empréstimos que ainda não foram devolvidos.
     * @return array Array de dados de empréstimos pendentes.
     */
    public function listarEmprestimosPendentes() {
        // Consulta SQL para buscar empréstimos sem data de devolução.
        $sql = "SELECT e.*, l.titulo FROM emprestimos e 
                         JOIN livros l ON e.livro_id = l.id 
                         WHERE e.data_devolucao IS NULL ORDER BY e.data_prevista_devolucao ASC";
        
        $stmt = $this->conexao->query($sql);
        // Retorna todos os resultados como array associativo.
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}