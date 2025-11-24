<?php

/**
 * Classe Livro (Entidade/Model)
 * Representa um registro na tabela 'livros' do banco de dados.
 * Contém apenas atributos e métodos de acesso (Getters/Setters).
 */
class Livro {
    // --- Atributos/Propriedades (Mapeiam as colunas da tabela) ---
    private $id;         // Chave primária (identificador único).
    private $titulo;     // Título do livro.
    private $autor;      // Nome do autor.
    private $ano;        // Ano de publicação.
    private $genero;     // Gênero literário.
    private $quantidade; // Número de cópias disponíveis em estoque.

    // -----------------------------------------------------------
    // --- Métodos Getters e Setters (Acesso e Modificação) ---
    // -----------------------------------------------------------

    public function getId() { return $this->id; }         // Getter: Retorna o valor da propriedade.
    public function setId($id) { $this->id = $id; }       // Setter: Define o valor da propriedade.

    public function getTitulo() { return $this->titulo; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }

    public function getAutor() { return $this->autor; }
    public function setAutor($autor) { $this->autor = $autor; }

    public function getAno() { return $this->ano; }
    public function setAno($ano) { $this->ano = $ano; }

    public function getGenero() { return $this->genero; }
    public function setGenero($genero) { $this->genero = $genero; }

    public function getQuantidade() { return $this->quantidade; }
    public function setQuantidade($quantidade) { $this->quantidade = $quantidade; }
}