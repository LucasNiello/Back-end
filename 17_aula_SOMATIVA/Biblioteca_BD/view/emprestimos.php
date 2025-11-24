<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Empréstimos</title>
    <link rel="stylesheet" href="assets/styleB.css">

</head>
<body>
    <div class="container">
        <h1>🔄 Gerenciamento de Empréstimos e Devoluções</h1>
        <p><a href="index.php?controller=livro">Voltar para o Catálogo de Livros</a></p>

        <?php
        // Bloco PHP para exibir mensagens de Feedback (sucesso ou erro)
        if (isset($_SESSION['feedback'])): 
            $mensagem = $_SESSION['feedback'];
            // Determina a classe CSS com base na presença da palavra 'Erro'.
            $tipo = strpos($mensagem, 'Erro') !== false ? 'feedback-error' : 'feedback-success';
            unset($_SESSION['feedback']); // Remove a mensagem da sessão após exibir.
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
                    // Loop para preencher o dropdown com livros que têm estoque > 0.
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
                        min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required> </div>
            
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
                // Verifica se há empréstimos pendentes para exibir.
                if (empty($emprestimosPendentes)): ?>
                    <tr>
                        <td colspan="6">Nenhum empréstimo pendente no momento.</td>
                    </tr>
                <?php else: ?>
                    <?php 
                    // Loop para listar cada empréstimo pendente.
                    foreach ($emprestimosPendentes as $emprestimo): 
                        // Lógica de Status: Verifica se a data prevista já passou.
                        $dataPrevista = new DateTime($emprestimo['data_prevista_devolucao']);
                        $hoje = new DateTime();
                        $atrasado = $dataPrevista < $hoje;
                    ?>
                        <tr class="<?= $atrasado ? 'vencido' : '' ?>"> <td><?= htmlspecialchars($emprestimo['titulo']) ?></td>
                            <td><?= htmlspecialchars($emprestimo['usuario_nome']) ?></td>
                            <td><?= date('d/m/Y', strtotime($emprestimo['data_emprestimo'])) ?></td>
                            <td><?= date('d/m/Y', $dataPrevista->getTimestamp()) ?></td>
                            <td><?= $atrasado ? '🔴 VENCIDO' : 'Em dia' ?></td>
                            <td>
                                <a href="index.php?controller=emprestimo&action=devolver&id=<?= $emprestimo['id'] ?>&livro_id=<?= $emprestimo['livro_id'] ?>" 
                                   class="btn-devolver" 
                                   onclick="return confirm('Confirmar devolução do livro: <?= htmlspecialchars($emprestimo['titulo']) ?>?')"> Devolver
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