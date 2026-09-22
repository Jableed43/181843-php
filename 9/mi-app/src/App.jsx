import './App.css'
import ListaAlumnos from './components/ListaAlumnos'
import alumnos from "./data/alumnos"

function App() {

  return (
    <>
    <h1>Alumnos del curso</h1>
      <ListaAlumnos alumnos={alumnos} />
    </>
  )
}

export default App
