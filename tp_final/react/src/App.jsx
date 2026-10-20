import "./App.css";
import { HashRouter, Routes, Route } from "react-router-dom";
import Menu from "./componentes/Menu";
import HomePage from "./paginas/HomePage";
import DetallePage from "./paginas/DetallePage";
import RegistroPage from "./paginas/RegistroPage";
import LoginPage from "./paginas/LoginPage";
import NotFoundPage from "./paginas/NotFoundPage";

// App = el "mapa" de la tienda: qué URL muestra qué página.
//
// Se usa HashRouter (las URLs quedan como .../#/producto/3) porque así el sitio
// funciona en GitHub Pages sin configurar nada en el servidor.
// Si lo publicás en un servidor propio, podés cambiarlo por BrowserRouter.
function App() {
  return (
    <HashRouter>
      {/* El Menu está FUERA de <Routes>: se ve en todas las páginas */}
      <Menu />

      <main className="contenedor">
        {/* Routes muestra UNA sola <Route>: la que coincide con la URL */}
        <Routes>
          <Route path="/" element={<HomePage />} />
          <Route path="/producto/:id" element={<DetallePage />} />
          <Route path="/registro" element={<RegistroPage />} />
          <Route path="/login" element={<LoginPage />} />
          {/* "*" atrapa cualquier URL que no coincidió con las de arriba */}
          <Route path="*" element={<NotFoundPage />} />
        </Routes>
      </main>

      <footer className="pie">TP Final · E-commerce con React</footer>
    </HashRouter>
  );
}

export default App;
