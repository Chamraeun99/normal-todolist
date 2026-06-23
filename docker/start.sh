#!/bin/sh

echo "=== Starting Todo List ==="

if [ -z "$APP_KEY" ]; then
  echo "FATAL: APP_KEY is not set in Render Environment."
  exit 1
fi

case "$APP_KEY" in
  base64:*)
    ;;
  *)
    echo "FATAL: APP_KEY must start with 'base64:'. Run locally: php artisan key:generate --show"
    exit 1
    ;;
esac

if [ -z "$DB_URL" ]; then
  echo "FATAL: DB_URL is not set in Render Environment."
  exit 1
fi

# channel_binding breaks PHP pdo_pgsql with Neon
export DB_URL=$(printf '%s' "$DB_URL" | sed 's/&channel_binding=require//g' | sed 's/?channel_binding=require&/?/g' | sed 's/?channel_binding=require//g')

mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

php artisan config:clear

php artisan migrate --force 2>&1 || echo "WARN: migrate failed (may already be up to date)"

php artisan db:seed --force --no-interaction 2>&1 || echo "WARN: seed skipped"

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Server starting on port ${PORT:-8000} ==="
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
