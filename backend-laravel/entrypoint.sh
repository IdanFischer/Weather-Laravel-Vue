#!/bin/sh
set -e

echo "Starting Laravel setup..."

if grep -q "APP_KEY=" .env; then
  echo "APP_KEY already exists. Skipping key generation..."
else
  echo "No APP_KEY found. Generating new Laravel APP_KEY..."
  php artisan key:generate
fi

echo "Starting Laravel server on 0.0.0.0:8000..."
php artisan serve --host=0.0.0.0 --port=8000
