import React from 'react'

// Los componentes funcionales a los parametros los llaman props
// las props son forma de comunicacion entre componentes

function ListaAlumnos({ alumnos }) {

  return (
    <div className='lista-alumnos'>
        {
            alumnos.map((alumno) => (
                <article key={alumno.id} className='tarjeta-alumno' >
                    <h3> {alumno.nombre} </h3>
                    <p> {alumno.curso} </p>
                    <span className='nota'>{alumno.nota}</span>
                </article>
            ))
        }
    </div>
  )
}

export default ListaAlumnos