import { useState } from "react";
import Casa from "./Casa";
import casas from "./datosCasas";

// Componente CONTENEDOR: tiene la lista completa y guarda CUÁL casa está
// elegida como favorita. Ese dato (el estado) vive acá, no en Casa.
function ListaCasas() {
  // TODO 2: declarar el estado "favorita", arrancando en null (nadie elegida todavía).
  // Pista: const [favorita, setFavorita] = useState(null);
  const [favorita, setFavorita] = useState(null)

  return (
    <div className="lista-casas">
      {casas.map((casa) => (
        <Casa
          key={casa.nombre}
          nombre={casa.nombre}
          valores={casa.valores}
          animal={casa.animal}
          color={casa.color}
          director={casa.director}
          ubicacion={casa.ubicacion}
          imagen={casa.imagen}
          esFavorita={casa.nombre === favorita}
          onElegir={() => setFavorita(casa.nombre)}
          // TODO 3: pasar esFavorita={casa.nombre === favorita}
          // TODO 4: pasar onElegir={() => setFavorita(casa.nombre)}
        />
      ))}
    </div>
  );
}

export default ListaCasas;
