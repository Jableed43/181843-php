<?php
require_once "Video.php";

class Serie extends Video {
    private $temporadas;

    // Podés notar que Serie no tiene constructor, esto es porque el constructor se utiliza cuando al instanciar queres guardar los valores de las propiedades, pero tambien puede no estar en algunos casos y podes setear los valores a través de metodos
    
    public function setTemporadas($temporadas) {
        $this->temporadas = $temporadas;
    }

    public function getTemporadas() {
        return $this->temporadas;
    }
}