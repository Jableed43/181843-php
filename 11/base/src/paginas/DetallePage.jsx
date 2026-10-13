import { Link } from "react-router-dom";
import casas from "../datos/casas";

// Página de detalle de UNA casa. Vive en la ruta /casas/:id
function DetallePage() {
  // TODO 6: leer el parámetro :id de la URL con useParams.
  //   1) agregar useParams al import de arriba:
  //        import { Link, useParams } from "react-router-dom";
  //   2) reemplazar la línea de abajo por:
  //        const { id } = useParams();
  const id = "gryffindor"; // ← valor fijo de prueba, hay que borrarlo

  const casa = casas.find((c) => c.id === id);

  // Si el id de la URL no coincide con ninguna casa, avisamos en vez de romper.
  if (!casa) {
    return (
      <section className="pagina">
        <h2>Casa no encontrada</h2>
        <p>No existe ninguna casa con el id "{id}".</p>
        <Link to="/casas">← Volver a las casas</Link>
      </section>
    );
  }

  return (
    <section className="pagina">
      <div className="detalle-banda" style={{ background: casa.colorHex }} />
      <h2>{casa.nombre}</h2>
      <ul className="detalle-lista">
        <li><strong>Valores:</strong> {casa.valores}</li>
        <li><strong>Animal:</strong> {casa.animal}</li>
        <li><strong>Colores:</strong> {casa.colores}</li>
        <li><strong>Fundador/a:</strong> {casa.fundador}</li>
        <li><strong>Director/a:</strong> {casa.director}</li>
        <li><strong>Ubicación:</strong> {casa.ubicacion}</li>
      </ul>
      <Link to="/casas">← Volver a las casas</Link>
    </section>
  );
}

export default DetallePage;
