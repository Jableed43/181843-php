// "Mock" de datos: un array de objetos comunes de JavaScript que hace de base de datos.
// Cada producto tiene un "id" único; ese id es el que viaja por la URL (/producto/3).
// (Son los mismos 8 productos de la versión de CodeIgniter.)
const productos = [
  { id: 1, codigo: "AUR-001", nombre: "Auriculares Bluetooth", precio: 45999, stock: 15 },
  { id: 2, codigo: "TEC-002", nombre: "Teclado Mecánico", precio: 78500, stock: 8 },
  { id: 3, codigo: "MOU-003", nombre: "Mouse Inalámbrico", precio: 18900, stock: 32 },
  { id: 4, codigo: "MON-004", nombre: 'Monitor 24" Full HD', precio: 189900, stock: 5 },
  { id: 5, codigo: "WEB-005", nombre: "Webcam HD 1080p", precio: 32500, stock: 0 },
  { id: 6, codigo: "MOC-006", nombre: "Mochila para Notebook", precio: 27800, stock: 20 },
  { id: 7, codigo: "CAR-007", nombre: "Cargador USB-C 65W", precio: 21400, stock: 40 },
  { id: 8, codigo: "PAD-008", nombre: "Pad Mouse XL", precio: 9800, stock: 60 },
];

export default productos;
