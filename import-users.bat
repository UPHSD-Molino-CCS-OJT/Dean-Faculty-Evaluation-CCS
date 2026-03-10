@echo off
REM Railway MySQL Import Script
REM 
REM Instructions:
REM 1. Get your MySQL connection details from Railway:
REM    - Railway Dashboard -> MySQL service -> Connect tab
REM 2. Update the variables below with your Railway MySQL credentials
REM 3. Run this script to import users.sql

echo ==========================================
echo Railway MySQL Data Import
echo ==========================================
echo.

REM Update these values from your Railway MySQL service
set MYSQL_HOST=your-mysql-host.railway.app
set MYSQL_PORT=3306
set MYSQL_USER=root
set MYSQL_PASSWORD=your-password-here
set MYSQL_DATABASE=railway

echo Connecting to: %MYSQL_USER%@%MYSQL_HOST%:%MYSQL_PORT%/%MYSQL_DATABASE%
echo.

REM Check if mysql client is installed
where mysql >nul 2>nul
if %errorlevel% neq 0 (
    echo ERROR: MySQL client not found!
    echo Please install MySQL client or use Railway's web console instead.
    pause
    exit /b 1
)

echo Importing users.sql...
mysql -h %MYSQL_HOST% -P %MYSQL_PORT% -u %MYSQL_USER% -p%MYSQL_PASSWORD% %MYSQL_DATABASE% < sql\users.sql

if %errorlevel% equ 0 (
    echo.
    echo ==========================================
    echo SUCCESS! Users data imported successfully
    echo ==========================================
    echo.
    echo Test login at your Railway URL:
    echo   Username: admin
    echo   Password: admin123
    echo.
    echo   OR
    echo.
    echo   Username: val.fabregas
    echo   Password: faculty123
) else (
    echo.
    echo ==========================================
    echo ERROR: Import failed!
    echo ==========================================
    echo.
    echo Try using Railway's web console instead:
    echo 1. Railway -> MySQL service -> Data -> Query
    echo 2. Copy/paste contents of sql\users.sql
    echo 3. Click Execute
)

pause
