<?php
require_once "Libro.php";

class Biblioteca {
    private array $libros = [];

    public function __construct() {
        $this->libros = [];
    }

    public function agregarLibro(Libro $libro): void {
        foreach ($this->libros as $l) {
            if ($l->getTitulo() === $libro->getTitulo() && $l->getAutor() === $libro->getAutor()) {
                echo "<p style='color:orange;'> El libro '{$libro->getTitulo()}' ya existe.</p>";
                return;
            }
        }
        $this->libros[] = $libro;
        echo "<p style='color:green;'>Libro agregado: {$libro->getInfo()}</p>";
    }

    public function listarLibros(): void {
        echo "<h3> Catálogo de Libros</h3>";
        if (empty($this->libros)) {
            echo "<p>No hay libros en la biblioteca.</p>";
            return;
        }

        echo "<ul>";
        foreach ($this->libros as $index => $libro) {
            echo "<li><strong>Libro #" . ($index + 1) . ":</strong> {$libro->getInfo()}</li>";
        }
        echo "</ul>";
    }

    public function contarLibros(): int {
        return count($this->libros);
    }

    public function mostrarEstadisticas(): void {
        echo "<h3> Estadísticas de la Biblioteca</h3>";
        echo "<p>Total de libros: <strong>{$this->contarLibros()}</strong></p>";

        if (!empty($this->libros)) {
            $totalPaginas = 0;
            foreach ($this->libros as $libro) {
                $totalPaginas += $libro->getPaginas();
            }
            $promedio = round($totalPaginas / $this->contarLibros(), 1);
            echo "<p>Total de páginas: <strong>{$totalPaginas}</strong></p>";
            echo "<p>Promedio de páginas por libro: <strong>{$promedio}</strong></p>";
        }
    }

    // Getter público para acceder a los libros desde fuera
    public function getLibros(): array {
        return $this->libros;
    }
}
?>