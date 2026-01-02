<?php

class Libro {
    // Atributos privados
    private string $titulo;
    private string $autor;
    private int $paginas;

    /**
     * Constructor: permite crear libro con o sin parámetros
     */
    public function __construct(string $titulo = "", string $autor = "", int $paginas = 1) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->paginas = $paginas > 0 ? $paginas : 1; // evita 0 páginas
    }

    // ==================== GETTERS ====================
    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getAutor(): string {
        return $this->autor;
    }

    public function getPaginas(): int {
        return $this->paginas;
    }

    // ==================== SETTERS ====================
    public function setTitulo(string $titulo): void {
        $this->titulo = $titulo;
    }

    public function setAutor(string $autor): void {
        $this->autor = $autor;
    }

    public function setPaginas(int $paginas): void {
        if ($paginas > 0) {
            $this->paginas = $paginas;
        } else {
            throw new Exception("El número de páginas debe ser positivo");
        }
    }

    // ==================== MÉTODOS ====================
    public function getInfo(): string {
        return "Título: {$this->titulo}, Autor: {$this->autor}, Páginas: {$this->paginas}";
    }
}
?>