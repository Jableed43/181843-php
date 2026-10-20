import { Link } from "react-router-dom";

// LOGIN: solo maquetado. Pide email y contraseña, como indica la consigna.
function LoginPage() {
  return (
    <form className="formulario" onSubmit={(e) => e.preventDefault()}>
      <h2>Iniciar sesión</h2>

      <div className="campo">
        <label htmlFor="email">Email</label>
        <input type="email" id="email" name="email" required />
      </div>

      <div className="campo">
        <label htmlFor="password">Contraseña</label>
        <input type="password" id="password" name="password" required />
      </div>

      <button type="submit" className="boton boton-ancho">Ingresar</button>
      <p className="nota-maqueta">Formulario de maqueta: todavía no envía datos.</p>

      <p className="alternativa">
        ¿No tenés cuenta? <Link to="/registro">Registrate</Link>
      </p>
    </form>
  );
}

export default LoginPage;
