@echo off
cd /d "%~dp0"

REM Run npm run dev in the background
start "npm run dev" /min npm run dev

REM Change to the "backend" folder and run npm run dev in the background
start "npm run dev (backend)" /min cmd /c "cd backend && npm run dev"

REM Run php artisan serve in the background
start "php artisan serve" /min php artisan serve
