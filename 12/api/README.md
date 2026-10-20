# API local de personajes (Harry Potter)

Servidor `json-server` con los mismos 437 personajes de `hp-api.onrender.com`, para que la demo de
`useFetch` funcione **sin internet** y sin depender de un servicio de terceros.

```bash
npm install     # una sola vez
npm run dev     # http://localhost:3001
```

| Pedido | Qué devuelve |
| :--- | :--- |
| `GET /characters` | Los 437 personajes (array) |
| `GET /characters?id=<id>` | Array con el personaje, o `[]` si no existe (igual que la API original) |
| `GET /characters?house=Gryffindor` | Filtra por cualquier campo |

Para que el `proyecto/` la use, en `proyecto/src/componentes/personajes/api.jsx` cambiar las dos URLs:
`https://hp-api.onrender.com/api/characters` → `http://localhost:3001/characters` y
`https://hp-api.onrender.com/api/character/${id}` → `http://localhost:3001/characters?id=${id}`.
