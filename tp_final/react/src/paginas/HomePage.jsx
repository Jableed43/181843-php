import productos from "../datos/productos";
import TarjetaProducto from "../componentes/TarjetaProducto";

// HOME: listado de productos.
// .map() recorre el array y dibuja UNA tarjeta por cada producto.
// "key" le da a React un identificador único por tarjeta.
function HomePage() {
  return (
    <>
      <h1>Productos</h1>

      <div className="grilla-productos">
        {productos.map((producto) => (
          <TarjetaProducto
            key={producto.id}
            id={producto.id}
            codigo={producto.codigo}
            nombre={producto.nombre}
            precio={producto.precio}
            stock={producto.stock}
          />
        ))}
      </div>
    </>
  );
}

export default HomePage;
