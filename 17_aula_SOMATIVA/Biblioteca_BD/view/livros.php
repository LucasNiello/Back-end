<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Livros da Biblioteca Escolar</title>
    <link rel="stylesheet" href="assets/styleB.css"> </head>
<body>
    <div class="container">
        <h1>📚 Catálogo de Livros da Biblioteca Escolar</h1>
        <p><a href="index.php?controller=emprestimo">Gerenciar Empréstimos e Devoluções</a></p>
        
        <?php
        // Bloco de Feedback Visual
        if (isset($_SESSION['feedback'])): // Verifica se há mensagens na sessão.
            $mensagem = $_SESSION['feedback'];
            $tipo = strpos($mensagem, 'Erro') !== false ? 'feedback-error' : 'feedback-success'; // Define a classe CSS.
            unset($_SESSION['feedback']); // Limpa a mensagem após exibir.
        ?>
            <div class="feedback <?= $tipo ?>">
                <?= nl2br(htmlspecialchars($mensagem)) ?>
            </div>
        <?php endif; ?>

        <?php
        // Lógica de Estado da View (Cadastro vs Edição)
        $livroEdicao = isset($_SESSION['livro_edicao']) ? $_SESSION['livro_edicao'] : null; // Verifica se há dados para editar.
        $acao = $livroEdicao ? 'atualizar' : 'salvar'; // Define a rota do formulário.
        $tituloForm = $livroEdicao ? 'Editar Livro' : 'Cadastrar Novo Livro'; // Altera o título dinamicamente.
        ?>

        <h2><?= $tituloForm ?></h2>
        <form method="POST" action="index.php?controller=livro&action=<?= $acao ?>">
            
            <?php if ($livroEdicao): ?>
                <input type="hidden" name="id_livro" value="<?= htmlspecialchars($livroEdicao['id']) ?>"> // ID necessário para o UPDATE.
            <?php endif; ?>

            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required 
                       value="<?= $livroEdicao ? htmlspecialchars($livroEdicao['titulo']) : '' ?>">
            </div>
            
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required
                       value="<?= $livroEdicao ? htmlspecialchars($livroEdicao['autor']) : '' ?>">
            </div>
            
            <div class="form-group">
                <label for="ano">Ano de Publicação:</label>
                <input type="number" id="ano" name="ano" required min="1000" max="<?= date('Y') + 1 ?>"
                       value="<?= $livroEdicao ? htmlspecialchars($livroEdicao['ano']) : '' ?>">
            </div>

            <div class="form-group">
                <label for="genero">Gênero Literário:</label>
                <input type="text" id="genero" name="genero" required
                       value="<?= $livroEdicao ? htmlspecialchars($livroEdicao['genero']) : '' ?>">
            </div>

            <div class="form-group">
                <label for="quantidade">Quantidade Disponível (Exemplares):</label>
                <input type="number" id="quantidade" name="quantidade" required min="1"
                       value="<?= $livroEdicao ? htmlspecialchars($livroEdicao['quantidade']) : '' ?>">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-salvar">Salvar Livro</button>
                
                <?php if ($livroEdicao): ?>
                    <a href="index.php?controller=livro&action=cancelar_edicao" class="btn-cancelar">Cancelar Edição</a>
                <?php endif; ?>
            </div>
        </form>

        ---
        
        <h2>Acervo da Biblioteca</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>Gênero</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($livros)): // Verifica se a lista vinda do Controller está vazia. ?>
                    <tr>
                        <td colspan="7">Nenhum livro cadastrado.</td>
                    </tr>
                <?php else: ?>
                    <?php 
                    foreach ($livros as $livro): // Itera sobre o array de objetos Livro. ?>
                        <tr>
                            <td><?= htmlspecialchars($livro->getId()) ?></td>
                            <td><?= htmlspecialchars($livro->getTitulo()) ?></td>
                            <td><?= htmlspecialchars($livro->getAutor()) ?></td>
                            <td><?= htmlspecialchars($livro->getAno()) ?></td>
                            <td><?= htmlspecialchars($livro->getGenero()) ?></td>
                            <td><?= htmlspecialchars($livro->getQuantidade()) ?></td>
                            <td>
                                <a href="index.php?controller=livro&action=editar&id=<?= $livro->getId() ?>" class="btn-editar">Editar</a>
                                <a href="index.php?controller=livro&action=excluir&id=<?= $livro->getId() ?>" 
                                   class="btn-excluir" 
                                   onclick="return confirm('ATENÇÃO: A exclusão é permanente! Tem certeza que deseja excluir o livro: <?= htmlspecialchars($livro->getTitulo()) ?>?')">
                                   Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
// Limpeza de Sessão
if (isset($_SESSION['livro_edicao']) && $acao === 'salvar') {
    unset($_SESSION['livro_edicao']); // Remove dados de edição se a ação voltou para salvar.
}