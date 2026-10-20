import { Link, NavLink } from "react-router-dom";

// Barra superior. Se dibuja FUERA de <Routes> (ver App.jsx), así aparece en todas las páginas.
// NavLink es un Link que agrega solo la clase "active" a la página en la que estás.
function Menu() {
  return (
    <header className="barra">
      <Link className="marca" to="/">🛒 Mi Tienda</Link>

      <nav className="menu">
        {/* "end" hace que "Inicio" no quede marcado en todas las páginas */}
        <NavLink to="/" end>Inicio</NavLink>
        <NavLink to="/login">Ingresar</NavLink>
        <NavLink to="/registro">Registrarse</NavLink>
      </nav>
    </header>
  );
}

export default Menu;
