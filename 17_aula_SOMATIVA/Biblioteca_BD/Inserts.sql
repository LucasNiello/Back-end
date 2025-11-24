USE biblioteca_db;

-- 1. Livro de Aventura/Fantasia
INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES 
('A Bússola de Ouro', 'Philip Pullman', 1995, 'Fantasia', 5);

-- 2. Livro Clássico da Literatura Brasileira
INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES 
('Dom Casmurro', 'Machado de Assis', 1899, 'Romance', 10);

-- 3. Livro de Ficção Científica
INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES 
('Duna', 'Frank Herbert', 1965, 'Ficção Científica', 3);

-- 4. Livro de Não-Ficção / História
INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES 
('1808', 'Laurentino Gomes', 2007, 'História', 7);

-- 5. Livro Infantil/Infanto-Juvenil
INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES 
('O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 1943, 'Infanto-Juvenil', 12);

-- 6. Livro de Suspense/Thriller
INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES 
('Garota Exemplar', 'Gillian Flynn', 2012, 'Suspense', 4);

-- 7. Livro de Poesia
INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES 
('Antologia Poética', 'Carlos Drummond de Andrade', 1962, 'Poesia', 6);

-- 8. Livro Técnico/Didático (Ex. Biologia)
INSERT INTO livros (titulo, autor, ano, genero, quantidade) VALUES 
('Fundamentos da Biologia', 'Various Authors', 2018, 'Didático', 9);


-- Define a data de hoje para o empréstimo (DATE(NOW()))
-- Define a data prevista para devolução (DATE_ADD(NOW(), INTERVAL 7 DAY))

-- 9. Empréstimo Pendente (A Bússola de Ouro)
INSERT INTO emprestimos (livro_id, usuario_nome, data_emprestimo, data_prevista_devolucao, data_devolucao) VALUES 
(1, 'Ana Silva (Turma 8A)', DATE(NOW()), DATE_ADD(NOW(), INTERVAL 7 DAY), NULL);

-- 10. Empréstimo Pendente (Dom Casmurro)
INSERT INTO emprestimos (livro_id, usuario_nome, data_emprestimo, data_prevista_devolucao, data_devolucao) VALUES 
(2, 'Pedro Rocha (Turma 9C)', DATE(NOW()), DATE_ADD(NOW(), INTERVAL 10 DAY), NULL);