import { Link } from "react-router-dom";
import casas from "../datos/casas";

// Lista de casas. Cada tarjeta es un <Link> que lleva a /casas/<id>:
// el <id> que armamos acá es el que DetallePage va a leer de la URL.
function CasasPage() {
  return (
    <section className="pagina">
      <h2>Las cuatro casas</h2>
      <div className="grid-casas">
        {casas.map((casa) => (
          <Link
            key={casa.id}
            to={`/casas/${casa.id}`}
            className="tarjeta-casa"
            style={{ borderTopColor: casa.colorHex }}
          >
            <h3>{casa.nombre}</h3>
            <p>{casa.valores}</p>
          </Link>
        ))}
      </div>
    </section>
  );
}

export default CasasPage;
