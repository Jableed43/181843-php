import { Link, useParams } from "react-router-dom";
import productos from "../datos/productos";
import { formatearPrecio } from "../utils/formato";

// DETALLE: un solo producto. Vive en la ruta /producto/:id
function DetallePage() {
  // useParams lee el ":id" de la URL. OJO: siempre llega como TEXTO ("3"),
  // por eso lo convertimos a número antes de compararlo con producto.id.
  const { id } = useParams();
  const producto = productos.find((p) => p.id === Number(id));

  // Si el id no existe (ej: /producto/999), avisamos en vez de romper la página.
  if (!producto) {
    return (
      <div className="detalle">
        <h1>Producto no encontrado</h1>
        <p>No existe ningún producto con el id "{id}".</p>
        <Link className="boton" to="/">&larr; Volver a los productos</Link>
      </div>
    );
  }

  return (
    <div className="detalle">
      <h1>{producto.nombre}</h1>

      <table>
        <tbody>
          <tr><th>Nombre</th><td>{producto.nombre}</td></tr>
          <tr><th>Precio</th><td>{formatearPrecio(producto.precio)}</td></tr>
          <tr>
            <th>Stock</th>
            <td>
              {producto.stock === 0 ? (
                <span className="stock stock-agotado">Agotado</span>
              ) : (
                `${producto.stock} unidades`
              )}
            </td>
          </tr>
          <tr><th>Código</th><td>{producto.codigo}</td></tr>
        </tbody>
      </table>

      <Link className="boton" to="/">&larr; Volver a los productos</Link>
    </div>
  );
}

export default DetallePage;
