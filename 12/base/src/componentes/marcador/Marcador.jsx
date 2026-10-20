import { marcadorReducer, estadoInicial } from "./marcadorReducer";

function Marcador({ casa, color }) {
  // TODO 8: manejar el estado con useReducer (reducer: marcadorReducer,
  // estado inicial: estadoInicial). Reemplazar estas dos líneas.
  const state = estadoInicial;
  const dispatch = () => {};

  return (
    <article className="marcador" style={{ borderTopColor: color }}>
      <h3>{casa}</h3>
      <p className="puntos">{state.puntos}</p>
      <p className="movimientos">Movimientos: {state.movimientos}</p>

      {/* TODO 9: conectar cada botón con dispatch: "sumar" y "restar" con
          cantidad 10, y "reiniciar" */}
      <button className="boton" onClick={() => {}}>
        +10
      </button>
      <button className="boton" onClick={() => {}}>
        -10
      </button>
      <button className="boton boton-secundario" onClick={() => {}}>
        Reiniciar
      </button>
    </article>
  );
}

export default Marcador;
