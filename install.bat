@echo off
md dist
xcopy install\* dist /E
cd dist\api
call composer install
git init
cd ..\front
call npm install
git init
cd ..\..