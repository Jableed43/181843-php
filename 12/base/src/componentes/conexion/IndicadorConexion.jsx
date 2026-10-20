import useEstadoConexion from "../../hooks/useEstadoConexion";

function IndicadorConexion() {
  // TODO 5: obtener "enLinea" llamando al hook useEstadoConexion
  const enLinea = useEstadoConexion()

  return (
    <span className="indicador">
      <span className={`punto ${enLinea ? "punto-verde" : "punto-rojo"}`} />
      {enLinea ? "En línea" : "Sin conexión"}
    </span>
  );
}

export default IndicadorConexion;
