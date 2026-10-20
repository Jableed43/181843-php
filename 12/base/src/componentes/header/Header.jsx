import IndicadorConexion from "../conexion/IndicadorConexion";

function Header() {
  return (
    <header className="header">
      <h1>Hogwarts · Copa de las Casas</h1>
      <IndicadorConexion />
    </header>
  );
}

export default Header;
