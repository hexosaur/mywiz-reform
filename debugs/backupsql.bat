@echo off

set DB_NAME=mywiz
set DB_USER=root
set DB_PASS=/fpVF4OE2Krr/AgQ
set BACKUP_DIR=K:\mywiz_backup

:: create folder if not exists
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

:: get date format YYYY-MM-DD
for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value') do set datetime=%%I
set DATE=%datetime:~0,4%-%datetime:~4,2%-%datetime:~6,2%

:: backup file
set FILE=%BACKUP_DIR%\%DB_NAME%_%DATE%.sql

:: run backup
"C:\xampp\mysql\bin\mysqldump.exe" -u %DB_USER% -p%DB_PASS% %DB_NAME% > "%FILE%"