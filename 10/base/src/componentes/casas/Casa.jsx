import "./Casa.css";
import Boton from "../boton/Boton";

// Componente de presentación: dibuja UNA casa. No sabe cuántas casas hay
// ni cuál está elegida como favorita — solo recibe esos datos por props.
function Casa({
  nombre,
  valores,
  animal,
  color,
  director,
  ubicacion,
  imagen,
  esFavorita,
  onElegir,
}) {
  return (
    // TODO 1: agregar la clase "favorita" cuando esFavorita sea true.
    // Pista: `tarjeta-casa ${esFavorita ? "favorita" : ""}`
    <section className="tarjeta-casa">
      <img src={imagen} alt={nombre} />
      <h2>{nombre}</h2>
      <p>{valores}</p>
      <p>
        <strong>Animal:</strong> {animal}
      </p>
      <p>
        <strong>Colores:</strong> {color}
      </p>
      <p>
        <strong>Director/a:</strong> {director}
      </p>
      <p>
        <strong>Ubicación:</strong> {ubicacion}
      </p>
      <Boton
        texto={esFavorita ? "★ Tu favorita" : "Elegir como favorita"}
        color={esFavorita ? "#ffd700" : "#007bff"}
        onClick={onElegir}
      />
    </section>
  );
}

export default Casa;
