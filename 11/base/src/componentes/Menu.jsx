// TODO 3: cambiar los <a href> por Link (ojo: la prop se llama "to")
// TODO 4: cambiar Link por NavLink; el de Inicio necesita la prop "end"
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
