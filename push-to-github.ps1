# Script pour envoyer le projet sur GitHub (Site_e-commerce)
# Executez dans PowerShell : cd C:\xampp\htdocs\e-commerce ; .\push-to-github.ps1

$ErrorActionPreference = "Stop"
Set-Location $PSScriptRoot

# Supprimer un .git partiel si present (optionnel)
if (Test-Path .git) {
    Remove-Item -Recurse -Force .git -ErrorAction SilentlyContinue
}

Write-Host "Initialisation du depot Git..." -ForegroundColor Cyan
git init

Write-Host "Ajout des fichiers..." -ForegroundColor Cyan
git add .

Write-Host "Premier commit..." -ForegroundColor Cyan
git commit -m "first commit - AtlasTech Solutions e-commerce"

Write-Host "Branche main..." -ForegroundColor Cyan
git branch -M main

Write-Host "Ajout du remote GitHub..." -ForegroundColor Cyan
git remote add origin https://github.com/Ljki1234/Site_e-commerce.git

Write-Host "Envoi vers GitHub (main)..." -ForegroundColor Cyan
git push -u origin main

Write-Host "Termine. Projet en ligne sur https://github.com/Ljki1234/Site_e-commerce" -ForegroundColor Green
