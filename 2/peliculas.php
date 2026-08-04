<!-- Propiedades -->
<!-- - titulo
- duracion -> number
- genero -> string
- lenguaje -> string
- director -> string
- listaActores -> lista
-->

<!-- Metodos -->
 <!-- - Reproducir
 - Pausar
 - Detener
 - ProxCapitulo
 - AntCapitulo
 - VerInfo -->

<?php

class Video {
    // Si es private no se puede acceder por fuera de la clase
    private $duracion;
    public function __construct($duracion) {
        $this->duracion = $duracion;
    }
    // Get, Getter -> metodos que traen valores
    // Si está privado solo podremos acceder a la propiedad a través de metodos
    public function getDuracion() {
        return $this->duracion;
    }
    // En caso de querer modificar duracion que es private usamos metodos
    // Setter -> metodo que modifica valor de una propiedad
    // Set -> modificar/configurar
    public function setDuracion($newDuracion) {
        $this->duracion = (int)$newDuracion;
    }
}

$peli = new Video(200);
// $peli->duracion = 120;
$peli->setDuracion(320);
echo $peli->getDuracion();
// Al estar privado no podemos acceder asi:
// echo $peli->duracion;