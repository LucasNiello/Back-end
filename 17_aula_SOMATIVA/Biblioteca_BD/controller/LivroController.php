<?php
// Carrega a Entidade (dados) e o DAO (acesso ao banco) do Livro.
require_once __DIR__ . '/../Model/Livro.php'; 
require_once __DIR__ . '/../Model/LivroDAO.php';

/**
 * LivroController
 * Gerencia todas as requisições relacionadas a Livros (CRUD).
 */
class LivroController {
    private $livroDAO; // Objeto de Data Access Object para comunicação com o DB.

    public function __construct() {
        // Inicializa o DAO para ter acesso aos métodos do banco.
        $this->livroDAO = new LivroDAO(); 
    }

    /**
     * Método padrão (Read All - R do CRUD).
     * Exibe a listagem de todos os livros.
     */
    public function index() {
        $livros = $this->livroDAO->lerLivros(); // Busca a lista completa de livros no DB.
        require_once __DIR__ . '/../View/livros.php'; // Carrega a View (interface).
    }

    /**
     * Processa o cadastro de um novo livro (Create - C do CRUD).
     * Requer o método POST.
     */
    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $livro = new Livro(); // Cria a Entidade Livro.
                // Atribui os dados do formulário (POST) ao objeto Livro.
                $livro->setTitulo($_POST['titulo']);
                $livro->setAutor($_POST['autor']);
                $livro->setAno((int)$_POST['ano']);
                $livro->setGenero($_POST['genero']);
                $livro->setQuantidade((int)$_POST['quantidade']);

                $this->livroDAO->criarLivro($livro); // Persiste o objeto no banco de dados.

                $_SESSION['feedback'] = "Livro **{$livro->getTitulo()}** cadastrado com sucesso!";
            } catch (Exception $e) {
                $_SESSION['feedback'] = "Erro ao cadastrar o livro: " . $e->getMessage();
            }
        }
        header('Location: index.php'); // Redireciona para evitar reenvio de formulário (PRG).
        exit;
    }

    /**
     * Prepara os dados de um livro para serem carregados no formulário de edição (Update).
     * @param int $id ID do livro a ser editado.
     */
    public function editar($id) {
        $livro = $this->livroDAO->buscarPorId($id); // Busca o livro no banco pelo ID.

        if ($livro) {
            // Salva os dados do livro na sessão para pré-popular o formulário na View.
            $_SESSION['livro_edicao'] = [
                'id' => $livro->getId(),
                'titulo' => $livro->getTitulo(),
                'autor' => $livro->getAutor(),
                'ano' => $livro->getAno(),
                'genero' => $livro->getGenero(),
                'quantidade' => $livro->getQuantidade(),
            ];
        }

        header('Location: index.php'); // Redireciona para a View principal.
        exit;
    }

    /**
     * Processa a atualização dos dados de um livro (Update - U do CRUD).
     * Requer o método POST.
     */
    public function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = (int)$_POST['id_livro']; // ID é necessário para saber qual registro atualizar.
                
                $livro = new Livro();
                $livro->setId($id);
                // Atribui todos os novos dados recebidos do formulário.
                $livro->setTitulo($_POST['titulo']);
                $livro->setAutor($_POST['autor']);
                $livro->setAno((int)$_POST['ano']);
                $livro->setGenero($_POST['genero']);
                $livro->setQuantidade((int)$_POST['quantidade']);

                $this->livroDAO->atualizarLivro($livro); // Executa a atualização no DB.

                $_SESSION['feedback'] = "Livro **{$livro->getTitulo()}** atualizado com sucesso!";
            } catch (Exception $e) {
                $_SESSION['feedback'] = "Erro ao atualizar o livro: " . $e->getMessage();
            }
            unset($_SESSION['livro_edicao']); // Limpa os dados de edição após a atualização.
        }
        header('Location: index.php');
        exit;
    }

    /**
     * Exclui um livro do banco de dados (Delete - D do CRUD).
     * @param int $id ID do livro a ser excluído.
     */
    public function excluir($id) {
        try {
            $livro = $this->livroDAO->buscarPorId($id);
            $titulo = $livro ? $livro->getTitulo() : "Registro"; // Título para feedback.

            $this->livroDAO->excluirLivro($id); // Executa a exclusão no DB.

            $_SESSION['feedback'] = "{$titulo} removido com sucesso!";
        } catch (Exception $e) {
            // Tratamento de erro SQL: '23000' geralmente indica violação de chave estrangeira.(FK)
            if ($e->getCode() == '23000') {
                 $_SESSION['feedback'] = "Erro: O livro **{$titulo}** não pode ser excluído, pois está atualmente emprestado. É necessário registrar a devolução antes de excluir.";
            } else {
                 $_SESSION['feedback'] = "Erro ao excluir o livro: " . $e->getMessage();
            }
        }
        header('Location: index.php');
        exit;
    }
}