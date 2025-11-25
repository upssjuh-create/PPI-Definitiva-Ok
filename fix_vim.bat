@echo off
taskkill /F /IM vim.exe 2>nul
taskkill /F /IM nvim.exe 2>nul
taskkill /F /IM gvim.exe 2>nul
echo Vim fechado
