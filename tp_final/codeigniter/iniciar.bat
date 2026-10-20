@echo off
chcp 65001 >nul
title Mi Tienda - CodeIgniter
cd /d "%~dp0"

echo ==================================================
echo   Mi Tienda (CodeIgniter) - iniciando...
echo ==================================================
echo.

rem ---------- 1) Buscar PHP (el que trae XAMPP, o el que haya en el PATH) ----------
set "XAMPP="
set "PHP="
for %%D in (C D E F) do (
    if exist "%%D:\xampp\php\php.exe" if not defined PHP (
        set "PHP=%%D:\xampp\php\php.exe"
        set "XAMPP=%%D:\xampp"
    )
)
if not defined PHP (
    where php >nul 2>nul && set "PHP=php"
)
if not defined PHP (
    echo No encontre PHP. Instala XAMPP desde https://www.apachefriends.org y volve a abrir este archivo.
    pause
    exit /b 1
)

rem ---------- 2) MySQL: si no esta encendido, intento encender el de XAMPP ----------
netstat -ano | findstr ":3306" | findstr "LISTENING" >nul
if errorlevel 1 (
    if defined XAMPP (
        echo Encendiendo MySQL de XAMPP...
        start "MySQL (no cierres esta ventana)" /min "%XAMPP%\mysql\bin\mysqld.exe" --defaults-file="%XAMPP%\mysql\bin\my.ini" --standalone --console
        ping -n 9 127.0.0.1 >nul
    ) else (
        echo MySQL no esta encendido. Abri el panel de XAMPP y presiona Start en MySQL.
        pause
    )
)

rem ---------- 3) Abrir el navegador y levantar el servidor ----------
rem (la base de datos se crea sola la primera vez: ver application/hooks/Instalador.php)
if not defined SIN_NAVEGADOR (
    start "" /min powershell -NoProfile -Command "Start-Sleep 2; Start-Process 'http://localhost:8000/index.php/'"
)

echo.
echo   Tienda lista en:  http://localhost:8000/index.php/
echo   Para cerrarla, cerra esta ventana o presiona Ctrl + C
echo.
"%PHP%" -S localhost:8000
