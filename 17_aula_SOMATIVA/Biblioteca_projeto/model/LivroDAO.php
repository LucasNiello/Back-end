<?php
// Garantia de inclusão das dependências
require_once __DIR__ . '/../config/Conexao.php';
require_once 'Livro.php';

class LivroDAO {
    private $conexao;

    public function __construct() {
        // Correção de instância da conexão
        $this->conexao = Conexao::getConexao();
    }

    /**
     * Insere um novo livro.
     * @param Livro $livro
     */
    public function criarLivro(Livro $livro) {
        $sql = "INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $livro->getTitulo());
        $stmt->bindValue(2, $livro->getAutor());
        $stmt->bindValue(3, $livro->getAno());
        $stmt->bindValue(4, $livro->getGenero());
        $stmt->bindValue(5, $livro->getQuantidade());
        $stmt->execute();
    }

    /**
     * Retorna todos os livros cadastrados.
     * @return array Um array de objetos Livro.
     */
    public function lerLivros() {
        $sql = "SELECT id, titulo, autor, ano, genero, quantidade FROM livros ORDER BY titulo ASC";
        $stmt = $this->conexao->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $livros = [];

        foreach ($resultados as $row) {
            $livro = new Livro();
            $livro->setId($row['id']);
            $livro->setTitulo($row['titulo']);
            $livro->setAutor($row['autor']);
            $livro->setAno($row['ano']);
            $livro->setGenero($row['genero']);
            $livro->setQuantidade($row['quantidade']);
            $livros[] = $livro;
        }
        return $livros;
    }
    
    /**
     * Busca um livro pelo ID.
     * @param int $id
     * @return Livro|null
     */
    public function buscarPorId($id) {
        $sql = "SELECT id, titulo, autor, ano, genero, quantidade FROM livros WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $livro = new Livro();
            $livro->setId($row['id']);
            $livro->setTitulo($row['titulo']);
            $livro->setAutor($row['autor']);
            $livro->setAno($row['ano']);
            $livro->setGenero($row['genero']);
            $livro->setQuantidade($row['quantidade']);
            return $livro;
        }
        return null;
    }

    /**
     * Atualiza os dados de um livro.
     * @param Livro $livro O objeto Livro com os dados atualizados.
     */
    public function atualizarLivro(Livro $livro) {
        $sql = "UPDATE livros SET titulo = ?, autor = ?, ano = ?, genero = ?, quantidade = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        
        $stmt->bindValue(1, $livro->getTitulo());
        $stmt->bindValue(2, $livro->getAutor());
        $stmt->bindValue(3, $livro->getAno());
        $stmt->bindValue(4, $livro->getGenero());
        $stmt->bindValue(5, $livro->getQuantidade());
        $stmt->bindValue(6, $livro->getId()); 

        $stmt->execute();
    }

    /**
     * Remove um livro.
     * @param int $id O ID do livro a ser excluído.
     */
    public function excluirLivro($id) {
        $sql = "DELETE FROM livros WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
    
    /**
     * Diminui a quantidade disponível de um livro. Chamado ao emprestar.
     * @param int $id ID do livro.
     */
    public function diminuirQuantidade($id) {
        $sql = "UPDATE livros SET quantidade = quantidade - 1 WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    /**
     * Aumenta a quantidade disponível de um livro. Chamado ao devolver.
     * @param int $id ID do livro.
     */
    public function aumentarQuantidade($id) {
        $sql = "UPDATE livros SET quantidade = quantidade + 1 WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}