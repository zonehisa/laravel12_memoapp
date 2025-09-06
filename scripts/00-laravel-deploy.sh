#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Setting up permissions..."
# Ensure database directory and file are writable
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod 664 /var/www/html/database/database.sqlite
chmod 775 /var/www/html/database

# Set proper ownership and permissions for storage
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

# Set proper ownership for database
chown -R www-data:www-data /var/www/html/database
chmod -R 775 /var/www/html/database

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Publishing Livewire assets..."
php artisan livewire:publish --assets

echo "Final permission check..."
# Ensure database file remains writable after migration
chmod 664 /var/www/html/database/database.sqlite
chown www-data:www-data /var/www/html/database/database.sqlite
