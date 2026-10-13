// TODO 3: importar Link desde "react-router-dom" y reemplazar cada <a href>
// por <Link to>. Ojo: el atributo se llama "to", no "href".
// TODO 4: cambiar <Link> por <NavLink> (importarlo también). En el link de
// inicio agregar la prop "end" para que no quede "activo" en todas las páginas.

// Por ahora son <a> comunes: cada click recarga la página ENTERA.
function Menu() {
  return (
    <nav className="menu">
      <a href="/">Inicio</a>
      <a href="/casas">Casas</a>
      <a href="/registro">Registro</a>
    </nav>
  );
}

export default Menu;
