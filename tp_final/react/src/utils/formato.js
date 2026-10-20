// Convierte 45999 en "$45.999,00" (formato argentino).
export function formatearPrecio(precio) {
  return "$" + precio.toLocaleString("es-AR", {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });
}
