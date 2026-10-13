// TODO 7: navegación programática (sin un <Link> que clickear).
//   1) importar el hook:
//        import { useNavigate } from "react-router-dom";
//   2) adentro del componente, antes de las funciones:
//        const navigate = useNavigate();
//   3) completar las dos funciones de abajo:
//        irAlInicio → navigate("/")
//        volver     → navigate(-1)   (un paso atrás en el historial)

function RegistroPage() {
  function irAlInicio() {
    // TODO 7: navigate("/");
  }

  function volver() {
    // TODO 7: navigate(-1);
  }

  return (
    <section className="pagina">
      <h2>Registro</h2>
      <p>Próximamente: formulario de inscripción a Hogwarts.</p>
      <button type="button" className="boton" onClick={irAlInicio}>
        Ir al inicio
      </button>
      <button type="button" className="boton boton-secundario" onClick={volver}>
        Volver
      </button>
    </section>
  );
}

export default RegistroPage;
