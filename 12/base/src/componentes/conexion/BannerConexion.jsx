import useEstadoConexion from "../../hooks/useEstadoConexion";

function BannerConexion() {
  // TODO 6: obtener "enLinea" llamando al mismo hook (cada componente tiene su propio estado)
  const enLinea = useEstadoConexion();

  if (enLinea) return null;

  return (
    <div className="banner-offline">
      ⚠️ Perdiste la conexión. Los cambios se guardan cuando vuelva internet.
    </div>
  );
}

export default BannerConexion;
