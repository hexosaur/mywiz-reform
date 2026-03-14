@echo off
setlocal EnableExtensions

set "PHP_EXE=C:\xampp\php\php.exe"
set "SCRIPT=C:\xampp\htdocs\mywiz-reform\pkg\js\cleantoken.php"
set "LOGDIR=C:\xampp\htdocs\mywiz-reform\logs"
set "LOGFILE=%LOGDIR%\token_cleanup.log"

REM Ensure logs dir exists FIRST
if not exist "%LOGDIR%" mkdir "%LOGDIR%"

for /f "tokens=1-3 delims=/:. " %%a in ("%date% %time%") do set "TS=%date% %time%"

if not exist "%PHP_EXE%" (
  echo [%TS%] ERROR: PHP not found: "%PHP_EXE%" >> "%LOGFILE%"
  exit /b 10
)

if not exist "%SCRIPT%" (
  echo [%TS%] ERROR: Script not found: "%SCRIPT%" >> "%LOGFILE%"
  exit /b 11
)

"%PHP_EXE%" "%SCRIPT%" >> "%LOGFILE%" 2>&1

set "RC=%ERRORLEVEL%"
echo [%TS%] DONE: ExitCode=%RC% >> "%LOGFILE%"

exit /b %RC%