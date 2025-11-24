-- Cria o banco de dados
CREATE DATABASE IF NOT EXISTS biblioteca_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE biblioteca_db;

-- 1. Tabela Livros (Acervo)
CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    ano INT NOT NULL,
    genero VARCHAR(100) NOT NULL,
    quantidade INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabela Empréstimos (Transações)
CREATE TABLE IF NOT EXISTS emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT NOT NULL, 
    usuario_nome VARCHAR(200) NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_prevista_devolucao DATE NOT NULL,
    data_devolucao DATE NULL, 
    
    -- Chave estrangeira que liga a transação ao livro no acervo
    CONSTRAINT fk_livro_emprestimo 
        FOREIGN KEY (livro_id) 
        REFERENCES livros(id) 
        ON DELETE RESTRICT -- Impede a exclusão de um livro que ainda possui empréstimos pendentes.
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;