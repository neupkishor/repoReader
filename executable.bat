@echo on

:: Start the PHP built-in server in a new window
echo Starting PHP server on localhost:8080...
start php -S localhost:8080

:: Wait for a few seconds to ensure the server starts
timeout /t 2 /nobreak

:: Open the default browser to localhost:8080
echo Opening the default browser to localhost:8080...
start http://localhost:8080

:: Wait for 5 seconds
timeout /t 5 /nobreak

:: Kill the PHP server
echo Stopping the PHP server...
taskkill /IM php.exe /F

:: Close the terminal window
echo Done. Exiting...
exit
