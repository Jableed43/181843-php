import "./App.css";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import Menu from "./componentes/Menu";
import HomePage from "./paginas/HomePage";
import CasasPage from "./paginas/CasasPage";
import DetallePage from "./paginas/DetallePage";
import RegistroPage from "./paginas/RegistroPage";
import NotFoundPage from "./paginas/NotFoundPage";

function App() {
  // TODO 1: instalar y activar el router de react-router-dom (pista: BrowserRouter)
  return (
    <div className="App">
      <BrowserRouter>
        {/* BrowserRouter activa el ruteo para todo lo que tiene adentro */}
        <Menu />
        {/* Menu se va a ver en todas las paginas por eso se encuentra aqui */}

        <main>
          <Routes>
            {/* Routes elina una sola ruta segun la url actual */}
            {/* TODO 2: mostrar una página distinta según la URL: "/", "/casas" y "/registro" (pista: Routes y Route) */}
            <Route path="/" element={<HomePage />} />
            <Route path="/casas" element={<CasasPage />} />
            {/* TODO 5: sumar la ruta del detalle de una casa; el id viaja en la URL */}
            <Route path="/casas/:id" element={<DetallePage />} />
            <Route path="/registro" element={<RegistroPage />} />

            {/* TODO 8: redirigir "/home" a "/" (pista: Navigate) */}
            <Route path="/home" element={<Navigate to="/" replace />} />
            {/* TODO 9: mostrar NotFoundPage para cualquier URL que no exista */}
            <Route path="*" element={<NotFoundPage />} />
          </Routes>
        </main>
      </BrowserRouter>
    </div>
  );
}

export default App;
