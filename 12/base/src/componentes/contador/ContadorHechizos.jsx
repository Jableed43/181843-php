import { useState, useEffect } from "react";

function ContadorHechizos() {
  // TODO 1: declarar el estado "hechizos" (arranca en 0) y reemplazar estas dos líneas
  const hechizos = 0;
  const setHechizos = () => {};

  // TODO 2: actualizar document.title con la cantidad de hechizos,
  // solo cuando "hechizos" cambie (pista: useEffect)

  return (
    <section className="seccion">
      <h2>Práctica de hechizos</h2>
      <p className="numero-grande">{hechizos}</p>
      <button className="boton" onClick={() => setHechizos(hechizos + 1)}>
        ¡Lanzar hechizo!
      </button>
      <button
        className="boton boton-secundario"
        onClick={() => setHechizos(0)}
      >
        Reiniciar
      </button>
    </section>
  );
}

export default ContadorHechizos;
