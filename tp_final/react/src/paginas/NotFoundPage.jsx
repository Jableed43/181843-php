import { Link } from "react-router-dom";

// Se muestra cuando la URL no coincide con ninguna ruta (404).
function NotFoundPage() {
  return (
    <div className="detalle">
      <h1>404 — Página no encontrada</h1>
      <p>La página que buscás no existe.</p>
      <Link className="boton" to="/">Volver al inicio</Link>
    </div>
  );
}

export default NotFoundPage;
