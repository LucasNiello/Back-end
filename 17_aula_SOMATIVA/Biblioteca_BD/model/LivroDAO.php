<?php
// Garantia de inclusão das dependências
require_once __DIR__ . '/../config/Conexao.php'; // Inclui a Conexão PDO (Singleton).
require_once 'Livro.php'; // Inclui a Entidade Livro.

/**
 * LivroDAO (Data Access Object)
 * Gerencia a persistência (CRUD) e o estoque da entidade Livro no banco de dados.
 */
class LivroDAO {
    private $conexao; // Instância PDO para executar consultas.

    public function __construct() {
        // Obtém a conexão PDO única através do padrão Singleton.
        $this->conexao = Conexao::getConexao(); 
    }

    /**
     * Insere um novo livro (Create - C do CRUD).
     * @param Livro $livro Objeto contendo os dados a serem salvos.
     */
    public function criarLivro(Livro $livro) {
        $sql = "INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        // Usa bindValue para segurança (evitar SQL Injection).
        $stmt->bindValue(1, $livro->getTitulo());
        $stmt->bindValue(2, $livro->getAutor());
        $stmt->bindValue(3, $livro->getAno());
        $stmt->bindValue(4, $livro->getGenero());
        $stmt->bindValue(5, $livro->getQuantidade());
        $stmt->execute();
    }

    /**
     * Retorna todos os livros cadastrados (Read All - R do CRUD).
     * @return array Um array de objetos Livro.
     */
    public function lerLivros() {
        $sql = "SELECT id, titulo, autor, ano, genero, quantidade FROM livros ORDER BY titulo ASC";
        $stmt = $this->conexao->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $livros = [];

        // Mapeamento Objeto-Relacional: Converte cada linha do DB em um objeto Livro.
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
     * Busca um livro pelo ID (Read One - R do CRUD).
     * @param int $id
     * @return Livro|null O objeto Livro encontrado ou nulo se não existir.
     */
    public function buscarPorId($id) {
        $sql = "SELECT id, titulo, autor, ano, genero, quantidade FROM livros WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC); // Busca apenas uma linha.

        if ($row) {
            $livro = new Livro(); // Cria o objeto e carrega os dados encontrados.
            $livro->setId($row['id']);
            $livro->setTitulo($row['titulo']);
            $livro->setAutor($row['autor']);
            $livro->setAno($row['ano']);
            $livro->setGenero($row['genero']);
            $livro->setQuantidade($row['quantidade']);
            return $livro;
        }
        return null; // Retorna nulo se nenhum registro for encontrado.
    }

    /**
     * Atualiza os dados de um livro (Update - U do CRUD).
     * @param Livro $livro O objeto Livro com os dados e o ID para o WHERE.
     */
    public function atualizarLivro(Livro $livro) {
        $sql = "UPDATE livros SET titulo = ?, autor = ?, ano = ?, genero = ?, quantidade = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        
        // Os primeiros 5 binds são os valores a serem atualizados.
        $stmt->bindValue(1, $livro->getTitulo());
        $stmt->bindValue(2, $livro->getAutor());
        $stmt->bindValue(3, $livro->getAno());
        $stmt->bindValue(4, $livro->getGenero());
        $stmt->bindValue(5, $livro->getQuantidade());
        $stmt->bindValue(6, $livro->getId()); // O último bind é o critério WHERE.

        $stmt->execute();
    }

    /**
     * Remove um livro (Delete - D do CRUD).
     * @param int $id O ID do livro a ser excluído.
     */
    public function excluirLivro($id) {
        $sql = "DELETE FROM livros WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
    
    // --- Funções de Gerenciamento de Estoque (Lógica de Negócio) ---

    /**
     * Diminui a quantidade disponível de um livro. Usado durante o Empréstimo.
     * @param int $id ID do livro.
     */
    public function diminuirQuantidade($id) {
        // Subtrai 1 diretamente no campo 'quantidade' do DB.
        $sql = "UPDATE livros SET quantidade = quantidade - 1 WHERE id = ?"; 
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    /**
     * Aumenta a quantidade disponível de um livro. Usado durante a Devolução.
     * @param int $id ID do livro.
     */
    public function aumentarQuantidade($id) {
        // Adiciona 1 diretamente no campo 'quantidade' do DB.
        $sql = "UPDATE livros SET quantidade = quantidade + 1 WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}