<?php
require_once __DIR__ . '/../config/Conexao.php';
require_once 'Emprestimo.php';
require_once 'LivroDAO.php'; 

class EmprestimoDAO {
    private $conexao;
    private $livroDAO;

    public function __construct() {
        $this->conexao = Conexao::getConexao();
        $this->livroDAO = new LivroDAO();
    }

    /**
     * Realiza um novo empréstimo e atualiza o estoque.
     * @param Emprestimo $emprestimo
     */
    public function realizarEmprestimo(Emprestimo $emprestimo) {
        $this->conexao->beginTransaction();
        
        try {
            $this->livroDAO->diminuirQuantidade($emprestimo->getLivroId());

            $sql = "INSERT INTO emprestimos (livro_id, usuario_nome, data_emprestimo, data_prevista_devolucao) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(1, $emprestimo->getLivroId());
            $stmt->bindValue(2, $emprestimo->getUsuarioNome());
            $stmt->bindValue(3, $emprestimo->getDataEmprestimo());
            $stmt->bindValue(4, $emprestimo->getDataPrevistaDevolucao());
            $stmt->execute();

            $this->conexao->commit();
            
        } catch (Exception $e) {
            $this->conexao->rollBack();
            throw $e; 
        }
    }

    /**
     * Registra a devolução e aumenta o estoque.
     * @param int $emprestimoId ID do empréstimo.
     * @param int $livroId ID do livro relacionado.
     */
    public function registrarDevolucao($emprestimoId, $livroId) {
        $this->conexao->beginTransaction();
        
        try {
            $this->livroDAO->aumentarQuantidade($livroId);

            $sql = "UPDATE emprestimos SET data_devolucao = NOW() WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $emprestimoId);
            $stmt->execute();

            $this->conexao->commit();
            
        } catch (Exception $e) {
            $this->conexao->rollBack();
            throw $e;
        }
    }

    /**
     * Retorna todos os empréstimos que ainda não foram devolvidos.
     * @return array Array de dados de empréstimos pendentes.
     */
    public function listarEmprestimosPendentes() {
        $sql = "SELECT e.*, l.titulo FROM emprestimos e 
                JOIN livros l ON e.livro_id = l.id 
                WHERE e.data_devolucao IS NULL ORDER BY e.data_prevista_devolucao ASC";
        
        $stmt = $this->conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}