import "./Seccion.css";
import Boton from "../boton/Boton";

function Seccion() {
  const handlerClicBoton = () => {
    alert("Hiciste click en el botón");
  };

  return (
    <section className="seccion">
      <h2>Información sobre Hogwarts</h2>
      <p>
        La escuela de magia y hechicería de Hogwarts es un lugar mágico donde
        los jóvenes magos aprenden a controlar sus poderes.
      </p>
      <div className="contenedor_img">
        <img src="/hogwarts.jpg" alt="Castillo de Hogwarts" />
      </div>
      <Boton color="#e91e8c" texto="Leer más" onClick={handlerClicBoton} />
    </section>
  );
}

export default Seccion;
