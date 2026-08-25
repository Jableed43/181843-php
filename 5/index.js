// Variable -> Espacio donde podemos almacenar valores para utilizarlos luego
// var
var nombre = "javier"
var nombre = "j"

// Si vas a modificar los valores de la variable
let apellido = "lopez"
apellido = "gimenez"

// Si no vas a modificar el valor de la variable
// pero vas a modificar un array o un objeto
const colorCabello = "negro"
// colorCabello = "rubio"

const persona = {
    colorCabello : "negro",
    nombre: "jose",
    apellido: "dorman"
}

const persona2 = {
    colorCabello : "negro"
}

persona.colorCabello = "rubio"

// Tipos de datos
// "string"
// 'string'
// backstick - alt + 96
// `string`

//numeros
// 0, 0.5, 5e5, -410

// boolean
// false, true

// Arrays
const estudiantes = ["jose", "javier", "matias", "ana", "luis", "marta", "pedro"]

// Iteracion -> bucles
for (let index = 0; index < estudiantes.length; index++) {
    const element = estudiantes[index];
    console.log(element)
}

// Faltó -> while, funciones, typeof