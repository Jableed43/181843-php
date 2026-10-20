import react from '@vitejs/plugin-react'
import { defineConfig } from 'vite'

// https://vite.dev/config/
export default defineConfig({
  plugins: [react()],
  // base "./" = los archivos se buscan con rutas relativas.
  // Así el proyecto funciona desde cualquier carpeta: GitHub Pages, un hosting, etc.
  base: './',
})
