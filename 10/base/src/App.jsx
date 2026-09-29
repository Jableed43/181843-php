import { useState } from "react";
import "./App.css";
import Header from "./componentes/header/Header";
import Footer from "./componentes/footer/Footer";
import Seccion from "./componentes/seccion/Seccion";
import ListaCasas from "./componentes/casas/ListaCasas";
import Reloj from "./componentes/reloj/Reloj";
import Boton from "./componentes/boton/Boton";

function App() {
  // TODO 7: declarar el estado "mostrarReloj", arrancando en true.
  // Pista: const [mostrarReloj, setMostrarReloj] = useState(true);

  return (
    <>
      <Header />
      <Seccion />

      <section className="seccion-reloj">
        <Boton
          texto="Mostrar/Ocultar reloj"
          color="#343434"
          // TODO 8: onClick={() => setMostrarReloj(!mostrarReloj)}
        />
        {/* TODO 9: mostrar <Reloj /> solo si mostrarReloj es true.
            Pista: {mostrarReloj && <Reloj />} */}
      </section>

      <ListaCasas />
      <Footer />
    </>
  );
}

export default App;
