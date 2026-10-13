import { Link } from "react-router-dom";

// Se muestra cuando la URL no coincide con ninguna ruta (404).
function NotFoundPage() {
  return (
    <section className="pagina">
      <h2>404 — Página no encontrada</h2>
      <p>La página que buscás no existe en Hogwarts.</p>
      <Link to="/">Volver al inicio</Link>
    </section>
  );
}

export default NotFoundPage;
