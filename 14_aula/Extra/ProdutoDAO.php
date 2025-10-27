<?php

class ProdutoDAO {
    private $produtos = [];
    private $arquivo = "produtos.json";

    public function __construct() {
        if (file_exists($this->arquivo)) {
            $dadosJson = file_get_contents($this->arquivo);
            $dadosArray = json_decode($dadosJson, true);
            if ($dadosArray) {
                foreach ($dadosArray as $codigo => $info) {
                    $this->produtos[$codigo] = new Produto(
                        $info['codigo'],
                        $info['nome'],
                        $info['preco']
                    );
                }
            }
        }
    }

    private function salvarEmArquivo() {
        $dados = [];
        foreach ($this->produtos as $codigo => $produto) {
            $dados[$codigo] = [
                'codigo' => $produto->getCodigo(),
                'nome' => $produto->getNome(),
                'preco' => $produto->getPreco()
            ];
        }
        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    // CREATE
    public function criarProduto(Produto $produto) {
        $this->produtos[$produto->getCodigo()] = $produto;
        $this->salvarEmArquivo();
    }

    // READ
    public function lerProdutos() {
        return $this->produtos;
    }

    // UPDATE
    public function atualizarProduto($codigo, $novoNome = null, $novoPreco = null) {
        if (isset($this->produtos[$codigo])) {
            if ($novoNome !== null) {
                $this->produtos[$codigo]->setNome($novoNome);
            }
            if ($novoPreco !== null) {
                $this->produtos[$codigo]->setPreco($novoPreco);
            }
            echo "Produto {$codigo} atualizado.\n";
        } else {
            echo "Produto {$codigo} não encontrado.\n";
        }
        $this->salvarEmArquivo();
    }

    // DELETE
    public function excluirProduto($codigo) {
        if (isset($this->produtos[$codigo])) {
            unset($this->produtos[$codigo]);
            echo "Produto {$codigo} excluído.\n";
        } else {
            echo "Produto {$codigo} não encontrado.\n";
        }
        $this->salvarEmArquivo();
    }
}


?>
