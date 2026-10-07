# Deployment Guide

## Production Deployment Steps

### 1. Requirements
- PHP 8.3+ with `pdo_mysql`, `pdo_sqlite`, `curl`, `json`, `mbstring`, `zlib`
- MySQL 8.0+ / MariaDB 10.6+
- SQLite 3+

### 2. Installation
1. Clone repository to webroot.
2. Run `composer install --no-dev --optimize-autoloader`.
3. Set environment variables in `.env` or web server config:
   - `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`
   - `API_TOKEN`, `AUTH_SECRET`
4. Apply MySQL schema: `mysql -u $DB_USER -p $DB_NAME < database/migrations/001_create_unified_schema.sql`
5. Ensure write permissions for SQLite directory and file: `chmod -R 775 download_queue.sqlite`

### 3. Nginx Configuration
```nginx
server {
    listen 80;
    server_name mm.3rah.ir;
    root /var/www/musicman;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```
