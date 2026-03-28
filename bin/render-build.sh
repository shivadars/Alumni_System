#!/usr/bin/env bash
# exit on error
set -o errexit

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node dependencies and Build Assets (Vite)
npm install
npm run build

# Clear old caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (Safe for Production)
php artisan migrate --force

# Ensure Admin exists
php artisan db:seed --class=AdminUserSeeder
