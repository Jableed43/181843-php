import { Link } from "react-router-dom";
import { formatearPrecio } from "../utils/formato";

// Componente de presentación: dibuja UNA tarjeta. Los datos le llegan por props.
// Toda la tarjeta es un Link que lleva a /producto/<id>.
function TarjetaProducto({ id, codigo, nombre, precio, stock }) {
  return (
    <Link className="tarjeta-producto" to={`/producto/${id}`}>
      <span className="codigo">{codigo}</span>
      <h3>{nombre}</h3>
      <span className="precio">{formatearPrecio(precio)}</span>

      {/* Etiqueta de stock según la cantidad */}
      {stock === 0 ? (
        <span className="stock stock-agotado">Agotado</span>
      ) : stock <= 10 ? (
        <span className="stock stock-bajo">¡Últimas {stock} unidades!</span>
      ) : (
        <span className="stock stock-ok">Stock: {stock}</span>
      )}
    </Link>
  );
}

export default TarjetaProducto;
