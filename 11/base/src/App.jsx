import "./App.css";
import Menu from "./componentes/Menu";
import HomePage from "./paginas/HomePage";
// TODO 1: importar desde "react-router-dom":
//   import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
// TODO 2: importar las páginas que faltan:
//   import CasasPage from "./paginas/CasasPage";
//   import RegistroPage from "./paginas/RegistroPage";
// TODO 5: importar DetallePage desde "./paginas/DetallePage"
// TODO 9: importar NotFoundPage desde "./paginas/NotFoundPage"

function App() {
  return (
    <div className="App">
      {/* TODO 1: envolver TODO lo que sigue (Menu + el contenido) con
          <BrowserRouter> ... </BrowserRouter> */}
      <Menu />

      <main>
        {/* TODO 2: reemplazar <HomePage /> por un bloque <Routes> con 3 rutas:
              <Routes>
                <Route path="/" element={<HomePage />} />
                <Route path="/casas" element={<CasasPage />} />
                <Route path="/registro" element={<RegistroPage />} />
              </Routes>

            TODO 5: sumar la ruta con parámetro:
              <Route path="/casas/:id" element={<DetallePage />} />

            TODO 8: sumar la redirección de /home a /:
              <Route path="/home" element={<Navigate to="/" replace />} />

            TODO 9: sumar, AL FINAL, la ruta comodín (404):
              <Route path="*" element={<NotFoundPage />} />  */}
        <HomePage />
      </main>
    </div>
  );
}

export default App;
