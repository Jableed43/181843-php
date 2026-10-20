import { useState, useEffect } from "react";

// PARTE 2 — Custom Hook
// Una función cuyo nombre empieza con "use" y que adentro usa otros hooks.
// Devuelve true si el navegador tiene conexión a internet, false si no.
function useEstadoConexion() {
  const [enLinea, setEnLinea] = useState(navigator.onLine);

  useEffect(() => {
    const handleOnline = () => setEnLinea(true);
    const handleOffline = () => setEnLinea(false);

    window.addEventListener("online", handleOnline);
    window.addEventListener("offline", handleOffline);

    // Limpieza: al desmontar, dejamos de escuchar (si no, los listeners
    // quedarían vivos aunque el componente ya no exista).
    return () => {
      window.removeEventListener("online", handleOnline);
      window.removeEventListener("offline", handleOffline);
    };
  }, []);

  return enLinea;
}

export default useEstadoConexion;
