#!/bin/sh
set -e

# Fix permissions for var directory (if it exists)
if [ -d "/var/www/html/var" ]; then
    # Try to fix permissions, but don't fail if it doesn't work (Windows volumes)
    chown -R www-data:www-data /var/www/html/var 2>/dev/null || true
    chmod -R 775 /var/www/html/var 2>/dev/null || true
    
    # Ensure cache directories exist and are writable
    mkdir -p /var/www/html/var/cache/dev
    mkdir -p /var/www/html/var/cache/prod
    mkdir -p /var/www/html/var/log
fi

# Execute the main command
exec "$@"
