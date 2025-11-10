<?php
// Arquivo: 15_aula/model/bebidasDAO.php

//======================================================================
// DEFINIÇÃO DA CLASSE BebidaDAO
//======================================================================
// Objetivo: Classe de Acesso a Dados (DAO) para gerenciar objetos 
//           'Bebida', usando um arquivo JSON (dados.json) como 
//           banco de dados simulado.
//======================================================================

require_once("bebidas.php"); // Inclui a definição da classe 'Bebida'

class BebidaDAO {
    
    // --- PROPRIEDADE: Arquivo de Dados ---
    // Define o caminho completo para o arquivo JSON que armazena os dados.
    private $arquivo = __DIR__ . "/dados.json"; 

    // --- CONSTRUTOR ---
    // É executado automaticamente quando a classe é instanciada.
    // Verifica se o arquivo JSON de dados já existe.
    // Se não existir, cria o arquivo com um array JSON vazio [].
    public function __construct() {
        if (!file_exists($this->arquivo)) {
            $this->salvarDados([]); // Cria o arquivo inicial
        }
    }

    // --- MÉTODO PRIVADO: lerDados ---
    // Função interna para ler o conteúdo do arquivo JSON.
    // Decodifica o JSON para um array associativo PHP.
    // Retorna um array vazio se o arquivo estiver vazio ou os dados 
    // forem inválidos, garantindo que a aplicação não quebre.
    private function lerDados() {
        $json = file_get_contents($this->arquivo);
        $dados = json_decode($json, true); // 'true' converte para array associativo
        return $dados ? $dados : []; // Garante que sempre retorne um array
    }

    // --- MÉTODO PRIVADO: salvarDados ---
    // Função interna para escrever dados no arquivo JSON.
    // Recebe um array PHP, converte para JSON formatado (PRETTY_PRINT).
    // 'array_values' garante que, mesmo após exclusões, o JSON seja salvo 
    // como um array [] e não como um objeto {} (preserva a ordem numérica).
    private function salvarDados($dados) {
        // Salva os dados, garantindo que arrays vazios se tornem [] e não {}
        $json = json_encode(array_values($dados), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($this->arquivo, $json);
    }

    // --- MÉTODO PÚBLICO: listar (READ ALL) ---
    // Busca todos os registros do arquivo JSON.
    // Converte cada registro (array) em um objeto 'Bebida'.
    // Retorna um array contendo todos os objetos 'Bebida'.
    public function listar() {
        $dados = $this->lerDados();
        $listaDeBebidas = [];

        foreach ($dados as $item) {
            // Cria um novo objeto Bebida "hidratando" com os dados do array
            $bebida = new Bebida(
                $item['nome'],
                $item['categoria'],
                $item['volume'],
                $item['valor'],
                $item['qtd'],
                $item['id'] // Passando o ID para o construtor
            );
            $listaDeBebidas[] = $bebida;
        }
        return $listaDeBebidas;
    }

    // --- MÉTODO PÚBLICO: adicionar (CREATE) ---
    // Recebe um objeto 'Bebida' pronto.
    // Lê os dados existentes, adiciona o novo objeto (convertido para array)
    // ao final da lista e salva tudo de volta no JSON.
    public function adicionar(Bebida $novaBebida) {
        $dados = $this->lerDados();
        // Assume que a classe Bebida tem um método toArray()
        $dados[] = $novaBebida->toArray(); 
        $this->salvarDados($dados);
    }

    // --- MÉTODO PÚBLICO: excluir (DELETE) ---
    // Recebe um ID.
    // Lê todos os dados e usa 'array_filter' para criar um novo array
    // contendo apenas os itens cujo ID seja DIFERENTE do ID a ser excluído.
    // Salva esse novo array filtrado no JSON.
    /**
     * Exclui uma bebida pelo seu ID único
     * @param string $id
     */
    public function excluir($id) {
        $dados = $this->lerDados();

        // Filtra o array, mantendo apenas os itens
        // cujo ID seja DIFERENTE do ID que queremos excluir.
        $dadosFiltrados = array_filter($dados, function($item) use ($id) {
            return $item['id'] !== $id;
        });

        // Salva os dados filtrados
        $this->salvarDados($dadosFiltrados);
    }

    // --- MÉTODO PÚBLICO: buscarPorId (READ SINGLE) ---
    // Recebe um ID.
    // Varre os dados e, ao encontrar o item com o ID correspondente,
    // cria e retorna um objeto 'Bebida' com esses dados.
    // Se não encontrar, retorna null.
    /**
     * Busca uma bebida específica pelo seu ID
     * @param string $id
     * @return Bebida|null
     */
    public function buscarPorId($id) {
        $dados = $this->lerDados();
        
        foreach ($dados as $item) {
            if ($item['id'] === $id) {
                // Encontrado! Retorna o objeto Bebida "hidratado"
                return new Bebida(
                    $item['nome'],
                    $item['categoria'],
                    $item['volume'],
                    $item['valor'],
                    $item['qtd'],
                    $item['id']
                );
            }
        }
        return null; // Não encontrado
    }

    // --- MÉTODO PÚBLICO: atualizar (UPDATE) ---
    // Recebe um objeto 'Bebida' já modificado.
    // Lê todos os dados, encontra o item com o ID correspondente 
    // (pelo índice/chave do array) e substitui o item antigo
    // pelo novo (convertido para array).
    // Salva todos os dados de volta no JSON.
    /**
     * Atualiza uma bebida existente no JSON
     * @param Bebida $bebidaAtualizada
     */
    public function atualizar(Bebida $bebidaAtualizada) {
        // Assume que a classe Bebida tem um método getId()
        $id = $bebidaAtualizada->getId(); 
        $dados = $this->lerDados();

        // Encontra o índice (chave) do item a ser atualizado
        $indiceParaAtualizar = -1;
        foreach ($dados as $indice => $item) {
            if ($item['id'] === $id) {
                $indiceParaAtualizar = $indice;
                break; // Encontrou o índice, pode parar o loop
            }
        }

        // Se encontrou (índice é válido)
        if ($indiceParaAtualizar !== -1) {
            // Substitui o item antigo pelo novo no array de dados
            $dados[$indiceParaAtualizar] = $bebidaAtualizada->toArray();
            $this->salvarDados($dados); // Salva o array modificado
        }
    }
} // --- FIM DA CLASSE BebidaDAO ---

?>