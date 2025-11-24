<?php

class Livro {
    private $id;
    private $titulo;
    private $autor;
    private $ano;
    private $genero;
    private $quantidade;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

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