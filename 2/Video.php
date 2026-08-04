<?php
// Clase PADRE. De acá heredan Serie y Pelicula.

class Video {
    // Propiedades principales
    protected $titulo;
    private $duracion;
    protected $genero;
    protected $lenguaje;
    protected $director;
    protected $listaActores = [];

    // constructor
    public function __construct($titulo, $duracion = null) {
        $this->titulo = $titulo;
        if ($duracion !== null) $this->setDuracion($duracion);
    }

    // metodos
    public function reproducir() {
        return "Reproduciendo {$this->titulo}";
    }

    // Getters / Setters
    public function getDuracion() {
        return $this->duracion;
    }

    public function setDuracion($newDuracion): void {
        $d = (int)$newDuracion;
        if ($d > 0) $this->duracion = $d;
    }

    // Métodos auxiliares (implementaciones simples para la demo)
    public function pausar() {
        return "Pausando {$this->titulo}";
    }

    public function detener() {
        return "Deteniendo {$this->titulo}";
    }

    public function proxCapitulo() {
        return "Siguiente capítulo de {$this->titulo}";
    }

    public function antCapitulo() {
        return "Capítulo anterior de {$this->titulo}";
    }

    public function verInfo() {
        $info = "Título: {$this->titulo}";
        if ($this->duracion) $info .= " - Duración: {$this->duracion}";
        if ($this->genero) $info .= " - Género: {$this->genero}";
        return $info;
    }
}
