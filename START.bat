@echo off
title Todo List - Dev Server
echo.
echo  Starting Todo List with PHP extensions enabled...
echo  Open: http://127.0.0.1:8000
echo  Press Ctrl+C to stop.
echo.
powershell -NoProfile -ExecutionPolicy Bypass -File "%~dp0serve.ps1"
