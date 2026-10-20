export const estadoInicial = { puntos: 0, movimientos: 0 };

// (estado actual, acción) => nuevo estado. Nunca modifica "state" directo.
export function marcadorReducer(state, action) {
  switch (action.type) {
    // TODO 7: agregar los casos "sumar" y "restar". Cada uno devuelve un objeto
    // nuevo con los puntos modificados en action.cantidad y movimientos + 1.
    case "reiniciar":
      return estadoInicial;
    default:
      throw new Error(`Acción desconocida: ${action.type}`);
  }
}
