// template string
let nombre = "jose"
let apellido = "dorman"

// Concatenacion
let saludo1 = "Hola " + "mi nombre es " + nombre + " " + apellido
console.log(saludo1)

// backsticks - ALT + 96 
let saludo2 = `Hola mi nombre es ${nombre} ${apellido}`
console.log(saludo2);

let cuenta = `${ 2 + 2 + 2 + 2 * 10 }`
console.log(cuenta);

// VAR
// Permite crear dos veces la misma variable (redeclarar), ERROR
var ejemplo = "mostrando ejemplo"
var ejemplo = "mostrando ejemplo 2"

// No usar

// LET -> no se puede redeclarar pero si reasignar
let ejemplo2 = "mostrando ejemplo"
ejemplo2 = "mostrando ejemplo 2"

// Ideal para valores que van a cambiar

// CONST
const ejemplo3 = "mostrando ejemplo 3"
// No permite redeclarar ni reasignar valores
// ejemplo3 = "mostrando ejemplo 3"

// Const es ideal para guardar elementos que no cambien
// funciones, puertos, valores constantes, ejecucion de una funcion
// No te deja cambiar valores que sean string, boolean, number
// si te deja cambiar valores internos de objetos y arrays
const ejemplo4 = []
// push inserta valores al final de un array
ejemplo4.push(1)
console.log(ejemplo4);

const ejemplo5 = {
    fruta: "manzana"
}
// dot notation -> te permite acceder a los valores de las claves de un objeto
ejemplo5.fruta = "mandarina"
console.log(ejemplo5);

// Las constantes cuidan la referencia y no el valor
// Las variables pueden guardar datos por referencia o valor
// 

console.log(1 === 1)

// en js los objetos y los arrays tienen indentidad propia, por lo tanto dos identicos no solo mismo

const ejemplo6 = {
    fruta: "manzana"
}

const ejemplo7 = {
    fruta: "manzana"
}
// Tecnicamente si ambos son iguales, tendria que dar true
// aca comparamos por valor
console.log(ejemplo6 === ejemplo7);

// En este caso si son identicos
// aca estamos trabajando por referencia
// es decir ejemplo8 y ejemplo6 son exactamente el mismo dato
const ejemplo8 = ejemplo6
console.log(ejemplo8 === ejemplo6);
ejemplo8.fruta = "banana"
console.log(ejemplo8, ejemplo6);