 <!-- Crea una clase `Pelicula` que herede de `Video`.  
 Define propiedad privada `$director`.  
 Implementa métodos:  
- `reproducir()`: "Reproduciendo película <título> dirigida por <director>".  
 - `mostrarCreditos()`: "Créditos: Dirigida por <director>". 
 
Crea un objeto `Pelicula` (ej.: "Inception").  -->

<!-- public(desde cualquier lado) -> protected (clase padre+hija) -> private(solo clase padre) -->

<?php
require_once "Video.php";

// Extends señala de quien heredamos
class Pelicula extends Video{
 // Hereda propiedades, constructor y metodos
 // Aun asi podes hacer algunas modificaciones
// No hace falta que escribamos todo de cero
// Reutilizacion y personalizacion de una clase nueva
 protected $director;

 public function __construct($titulo, $director){
    parent::__construct($titulo);
    $this->director = $director; 
 }

 // Override -> sobreescribe implementacion de algun metodo heredado
// Toma lo heredado y lo personaliza
 public function reproducir() {
        return "Reproduciendo {$this->titulo} dirigida por {$this->director}";
    }

 public function mostrarCreditos(){
    return "Créditos: Dirigida por {$this->director}";
 }
}

$peli = new Pelicula("Inception", "Christopher Nolan");
echo $peli->reproducir() . "<br>";
echo $peli->mostrarCreditos() . "<br>";