<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Livros da Biblioteca Escolar</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f9; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h1, h2 { border-bottom: 2px solid #ccc; padding-bottom: 10px; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .form-actions button { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px; }
        .btn-salvar { background-color: #5cb85c; color: white; }
        .btn-cancelar { background-color: #f0ad4e; color: white; text-decoration: none; padding: 10px 15px; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 12px; text-align: left; }
        th { background-color: #007bff; color: white; }
        .btn-editar, .btn-excluir { padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; color: white; margin-right: 5px; text-decoration: none; }
        .btn-editar { background-color: #007bff; }
        .btn-excluir { background-color: #dc3545; }
        .feedback { padding: 10px; margin-bottom: 20px; border-radius: 4px; font-weight: bold; }
        .feedback-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;}
        .feedback-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;}
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 Catálogo de Livros da Biblioteca Escolar</h1>
        <p><a href="index.php?controller=emprestimo">Gerenciar Empréstimos e Devoluções</a></p>
        
        <?php
        if (isset($_SESSION['feedback'])): 
            $mensagem = $_SESSION['feedback'];
            $tipo = strpos($mensagem, 'Erro') !== false ? 'feedback-error' : 'feedback-success';
            unset($_SESSION['feedback']);
        ?>
            <div class="feedback <?= $tipo ?>">
                <?= nl2br(htmlspecialchars($mensagem)) ?>
            </div>
        <?php endif; ?>

        <?php
        $livroEdicao = isset($_SESSION['livro_edicao']) ? $_SESSION['livro_edicao'] : null;
        $acao = $livroEdicao ? 'atualizar' : 'salvar';
        $tituloForm = $livroEdicao ? 'Editar Livro' : 'Cadastrar Novo Livro';
        ?>

        <h2><?= $tituloForm ?></h2>
        <form method="POST" action="index.php?controller=livro&action=<?= $acao ?>">
            
            <?php if ($livroEdicao): ?>
                <input type="hidden" name="id_livro" value="<?= htmlspecialchars($livroEdicao['id']) ?>">
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
                <?php if (empty($livros)): ?>
                    <tr>
                        <td colspan="7">Nenhum livro cadastrado.</td>
                    </tr>
                <?php else: ?>
                    <?php 
                    foreach ($livros as $livro): ?>
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
if (isset($_SESSION['livro_edicao']) && $acao === 'salvar') {
    unset($_SESSION['livro_edicao']);
}