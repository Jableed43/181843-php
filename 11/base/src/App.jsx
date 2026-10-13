import "./App.css";
import Menu from "./componentes/Menu";
import HomePage from "./paginas/HomePage";
// TODO 2: importar CasasPage y RegistroPage
// TODO 5: importar DetallePage
// TODO 9: importar NotFoundPage

function App() {
  // TODO 1: instalar y activar el router de react-router-dom (pista: BrowserRouter)
  return (
    <div className="App">
      <Menu />

      <main>
        {/* TODO 2: mostrar una página distinta según la URL: "/", "/casas" y "/registro" (pista: Routes y Route) */}
        {/* TODO 5: sumar la ruta del detalle de una casa; el id viaja en la URL */}
        {/* TODO 8: redirigir "/home" a "/" (pista: Navigate) */}
        {/* TODO 9: mostrar NotFoundPage para cualquier URL que no exista */}
        <HomePage />
      </main>
    </div>
  );
}

export default App;
