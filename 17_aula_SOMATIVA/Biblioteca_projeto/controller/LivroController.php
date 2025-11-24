<?php
// INCLUSÃO CORRIGIDA: Precisamos da Entidade Livro, além do DAO
require_once __DIR__ . '/../Model/Livro.php';
require_once __DIR__ . '/../Model/LivroDAO.php';

class LivroController {
    private $livroDAO;

    public function __construct() {
        $this->livroDAO = new LivroDAO();
    }

    public function index() {
        $livros = $this->livroDAO->lerLivros();
        require_once __DIR__ . '/../View/livros.php';
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $livro = new Livro();
                $livro->setTitulo($_POST['titulo']);
                $livro->setAutor($_POST['autor']);
                $livro->setAno((int)$_POST['ano']);
                $livro->setGenero($_POST['genero']);
                $livro->setQuantidade((int)$_POST['quantidade']);

                $this->livroDAO->criarLivro($livro);

                $_SESSION['feedback'] = "Livro **{$livro->getTitulo()}** cadastrado com sucesso!";
            } catch (Exception $e) {
                $_SESSION['feedback'] = "Erro ao cadastrar o livro: " . $e->getMessage();
            }
        }
        header('Location: index.php');
        exit;
    }

    public function editar($id) {
        $livro = $this->livroDAO->buscarPorId($id);

        if ($livro) {
            $_SESSION['livro_edicao'] = [
                'id' => $livro->getId(),
                'titulo' => $livro->getTitulo(),
                'autor' => $livro->getAutor(),
                'ano' => $livro->getAno(),
                'genero' => $livro->getGenero(),
                'quantidade' => $livro->getQuantidade(),
            ];
        }

        header('Location: index.php');
        exit;
    }

    public function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = (int)$_POST['id_livro']; 
                
                $livro = new Livro();
                $livro->setId($id);
                $livro->setTitulo($_POST['titulo']);
                $livro->setAutor($_POST['autor']);
                $livro->setAno((int)$_POST['ano']);
                $livro->setGenero($_POST['genero']);
                $livro->setQuantidade((int)$_POST['quantidade']);

                $this->livroDAO->atualizarLivro($livro);

                $_SESSION['feedback'] = "Livro **{$livro->getTitulo()}** atualizado com sucesso!";
            } catch (Exception $e) {
                $_SESSION['feedback'] = "Erro ao atualizar o livro: " . $e->getMessage();
            }
            unset($_SESSION['livro_edicao']);
        }
        header('Location: index.php');
        exit;
    }

    public function excluir($id) {
        try {
            $livro = $this->livroDAO->buscarPorId($id);
            $titulo = $livro ? $livro->getTitulo() : "Registro";

            $this->livroDAO->excluirLivro($id);

            $_SESSION['feedback'] = "{$titulo} removido com sucesso!";
        } catch (Exception $e) {
            // Tratamento específico para erro de integridade referencial (livro emprestado)
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