#!/bin/bash
set -e

# Install Composer dependencies if vendor/ directory is missing
if [ ! -d "vendor" ] && [ -f "composer.json" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-interaction --optimize-autoloader
fi

# For Laravel: wait for DB, then run migrations
if [ -f "artisan" ]; then
    echo "Waiting for database..."
    max_tries=30
    count=0
    until php artisan db:monitor --databases=mysql > /dev/null 2>&1 || [ $count -ge $max_tries ]; do
        sleep 2
        count=$((count + 1))
    done

    if [ $count -lt $max_tries ]; then
        echo "Database is ready. Running migrations..."
        php artisan migrate --force --graceful 2>/dev/null || true
    else
        echo "Warning: Database not available after ${max_tries} attempts. Skipping migrations."
    fi
fi

exec "$@"

