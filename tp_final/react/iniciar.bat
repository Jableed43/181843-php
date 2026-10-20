@echo off
chcp 65001 >nul
title Mi Tienda - React
cd /d "%~dp0"

echo ==================================================
echo   Mi Tienda (React) - iniciando...
echo ==================================================
echo.

rem ---------- 1) Node.js ----------
where node >nul 2>nul
if errorlevel 1 (
    echo No encontre Node.js. Instalalo desde https://nodejs.org y volve a abrir este archivo.
    pause
    exit /b 1
)

rem ---------- 2) Instalar las librerias (solo la primera vez) ----------
if not exist node_modules (
    echo Instalando librerias - solo la primera vez, puede tardar un minuto...
    call npm install
    if errorlevel 1 (
        echo.
        echo Fallo la instalacion. Revisa tu conexion a internet y volve a intentar.
        pause
        exit /b 1
    )
)

rem ---------- 3) Levantar la tienda y abrir el navegador ----------
echo.
echo   Para cerrarla, cerra esta ventana o presiona Ctrl + C
echo.
if defined SIN_NAVEGADOR (
    call npm run dev
) else (
    call npm run dev -- --open
)
