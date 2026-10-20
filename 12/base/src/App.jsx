import "./App.css";
import Header from "./componentes/header/Header";
import BannerConexion from "./componentes/conexion/BannerConexion";
import ContadorHechizos from "./componentes/contador/ContadorHechizos";
import CopaDeLasCasas from "./componentes/marcador/CopaDeLasCasas";

function App() {
  return (
    <>
      <Header />
      <BannerConexion />
      <ContadorHechizos />
      <CopaDeLasCasas />
    </>
  );
}

export default App;
