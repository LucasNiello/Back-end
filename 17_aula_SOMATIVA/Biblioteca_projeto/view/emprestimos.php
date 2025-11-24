<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Empréstimos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f9; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h1, h2 { border-bottom: 2px solid #ccc; padding-bottom: 10px; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .form-actions button { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px; }
        .btn-salvar { background-color: #5cb85c; color: white; }
        .btn-devolver { background-color: #337ab7; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none;}
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 12px; text-align: left; }
        th { background-color: #337ab7; color: white; }
        .feedback { padding: 10px; margin-bottom: 20px; border-radius: 4px; font-weight: bold; }
        .feedback-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;}
        .feedback-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;}
        .vencido { background-color: #f2dede; color: #a94442; font-weight: bold; } 
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 Gerenciamento de Empréstimos e Devoluções</h1>
        <p><a href="index.php?controller=livro">Voltar para o Catálogo de Livros</a></p>

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

        <h2>Realizar Novo Empréstimo</h2>
        <form method="POST" action="index.php?controller=emprestimo&action=emprestar">
            <div class="form-group">
                <label for="livro_id">Livro (Disponível em Estoque):</label>
                <select name="livro_id" id="livro_id" required>
                    <option value="">Selecione um Livro</option>
                    <?php 
                    foreach ($livrosDisponiveis as $livro): 
                        if ($livro->getQuantidade() > 0): 
                    ?>
                        <option value="<?= $livro->getId() ?>">
                            <?= htmlspecialchars($livro->getTitulo()) ?> (Disp: <?= $livro->getQuantidade() ?>)
                        </option>
                    <?php 
                        endif;
                    endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="usuario_nome">Nome do Aluno/Usuário:</label>
                <input type="text" id="usuario_nome" name="usuario_nome" required>
            </div>
            
            <div class="form-group">
                <label for="data_prevista_devolucao">Data Prevista de Devolução:</label>
                <input type="date" id="data_prevista_devolucao" name="data_prevista_devolucao" 
                       min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-salvar">Registrar Empréstimo</button>
            </div>
        </form>

        ---
        
        <h2>Empréstimos Pendentes</h2>
        <table>
            <thead>
                <tr>
                    <th>Livro</th>
                    <th>Usuário</th>
                    <th>Data Empréstimo</th>
                    <th>Devolução Prevista</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (empty($emprestimosPendentes)): ?>
                    <tr>
                        <td colspan="6">Nenhum empréstimo pendente no momento.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($emprestimosPendentes as $emprestimo): 
                        $dataPrevista = new DateTime($emprestimo['data_prevista_devolucao']);
                        $hoje = new DateTime();
                        $atrasado = $dataPrevista < $hoje;
                    ?>
                        <tr class="<?= $atrasado ? 'vencido' : '' ?>">
                            <td><?= htmlspecialchars($emprestimo['titulo']) ?></td>
                            <td><?= htmlspecialchars($emprestimo['usuario_nome']) ?></td>
                            <td><?= date('d/m/Y', strtotime($emprestimo['data_emprestimo'])) ?></td>
                            <td><?= date('d/m/Y', $dataPrevista->getTimestamp()) ?></td>
                            <td><?= $atrasado ? '🔴 VENCIDO' : 'Em dia' ?></td>
                            <td>
                                <a href="index.php?controller=emprestimo&action=devolver&id=<?= $emprestimo['id'] ?>&livro_id=<?= $emprestimo['livro_id'] ?>" 
                                   class="btn-devolver" 
                                   onclick="return confirm('Confirmar devolução do livro: <?= htmlspecialchars($emprestimo['titulo']) ?>?')">
                                   Devolver
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