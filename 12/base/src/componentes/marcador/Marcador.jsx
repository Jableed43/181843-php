import { useReducer } from "react";
import { marcadorReducer, estadoInicial } from "./marcadorReducer";

function Marcador({ casa, color }) {
  // TODO 8: manejar el estado con useReducer (reducer: marcadorReducer,
  // estado inicial: estadoInicial). Reemplazar estas dos líneas.
  const [state, dispatch] = useReducer(marcadorReducer, estadoInicial)

  return (
    <article className="marcador" style={{ borderTopColor: color }}>
      <h3>{casa}</h3>
      <p className="puntos">{state.puntos}</p>
      <p className="movimientos">Movimientos: {state.movimientos}</p>

      {/* TODO 9: conectar cada botón con dispatch: "sumar" y "restar" con
          cantidad 10, y "reiniciar" */}
      <button className="boton" onClick={() => dispatch({type: "sumar", cantidad: 10})}>
        +10
      </button>
      <button className="boton" onClick={() => dispatch({type: "restar", cantidad: 10})}>
        -10
      </button>
      <button className="boton boton-secundario" onClick={() => dispatch({type: "reiniciar"})}>
        Reiniciar
      </button>
    </article>
  );
}

export default Marcador;
