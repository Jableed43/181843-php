import { Link } from "react-router-dom";

// REGISTRO: solo maquetado (la consigna no pide guardar datos en la versión React).
// onSubmit con preventDefault() evita que el navegador recargue la página al enviar.
function RegistroPage() {
  return (
    <form className="formulario" onSubmit={(e) => e.preventDefault()}>
      <h2>Crear cuenta</h2>

      <div className="campo">
        <label htmlFor="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required />
      </div>

      <div className="campo">
        <label htmlFor="email">Email</label>
        <input type="email" id="email" name="email" required />
      </div>

      <div className="campo">
        <label htmlFor="password">Contraseña</label>
        <input type="password" id="password" name="password" minLength={6} required />
      </div>

      <div className="campo">
        <label htmlFor="password2">Repetir contraseña</label>
        <input type="password" id="password2" name="password2" minLength={6} required />
      </div>

      <button type="submit" className="boton boton-ancho">Registrarme</button>
      <p className="nota-maqueta">Formulario de maqueta: todavía no envía datos.</p>

      <p className="alternativa">
        ¿Ya tenés cuenta? <Link to="/login">Iniciá sesión</Link>
      </p>
    </form>
  );
}

export default RegistroPage;
