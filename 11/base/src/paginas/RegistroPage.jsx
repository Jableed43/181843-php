function RegistroPage() {
  // TODO 7: que los botones naveguen: "Ir al inicio" lleva a "/" y "Volver" retrocede
  // un paso en el historial (pista: useNavigate)
  function irAlInicio() {}

  function volver() {}

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
