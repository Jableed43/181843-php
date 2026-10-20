import { useState, useEffect } from "react";

// Custom Hook: devuelve true si el navegador tiene conexión a internet.
function useEstadoConexion() {
  // TODO 3: guardar en un estado si hay conexión; el valor inicial lo da
  // navigator.onLine. Reemplazar estas dos líneas.
  const enLinea = true;
  const setEnLinea = () => {};

  // TODO 4: escuchar los eventos "online" y "offline" de window para actualizar
  // el estado, y dejar de escucharlos al desmontar (pista: useEffect con limpieza)

  return enLinea;
}

export default useEstadoConexion;
