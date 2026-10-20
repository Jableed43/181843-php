import casas from "../../datos/casas";
import Marcador from "./Marcador";

// Renderiza un Marcador por cada casa. Cada Marcador tiene SU PROPIO
// estado: sumarle puntos a una casa no toca a las otras.
function CopaDeLasCasas() {
  return (
    <section className="seccion">
      <h2>Copa de las Casas</h2>
      <div className="grid-marcadores">
        {casas.map((casa) => (
          <Marcador key={casa.nombre} casa={casa.nombre} color={casa.color} />
        ))}
      </div>
    </section>
  );
}

export default CopaDeLasCasas;
