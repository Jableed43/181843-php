import { useState, useEffect } from "react";
import "./Reloj.css";

// Este componente demuestra el ciclo de vida con hooks:
// - "montaje" (componentDidMount) → lo que corre dentro de useEffect la primera vez.
// - "desmontaje" (componentWillUnmount) → lo que corre en el return (la limpieza).
function Reloj() {
  const [hora, setHora] = useState(new Date());

  useEffect(() => {
    console.log("Reloj: montado");

    const intervalo = setInterval(() => {
      setHora(new Date())
    }, 1000)
    // TODO 5: crear un setInterval que, cada 1000ms, llame a setHora(new Date())
    // y guardar lo que devuelve en una variable (ej. const intervalo = ...).

    return () => {
      console.log("Reloj desmontado")
      clearInterval(intervalo)
    }

    // TODO 6: devolver una función de limpieza que haga console.log("Reloj: desmontado")
    // y clearInterval(intervalo) — esa función corre cuando el componente se saca de pantalla.
  }, []); // el array vacío significa "solo al montar, una vez"

  return (
    <div className="reloj">
      🕐 {hora.toLocaleTimeString()}
    </div>
  );
}

export default Reloj;
