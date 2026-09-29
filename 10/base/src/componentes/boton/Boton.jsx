import "./Boton.css";

// Componente de presentación: recibe props y las usa. No sabe qué hace
// "onClick" cuando se lo aprieta — eso lo decide quien use el botón.
function Boton({ texto, color, onClick }) {
  const estilosBoton = {
    backgroundColor: color,
  };

  return (
    <button style={estilosBoton} onClick={onClick} className="boton">
      {texto}
    </button>
  );
}

export default Boton;
