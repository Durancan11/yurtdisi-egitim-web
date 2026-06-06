FROM php:8.2-cli

# 1. Sunucu için gerekli temel paketler, PostgreSQL eklentisi ve Node.js (Tailwind için)
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Composer'ı sisteme dahil et
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Proje dosyalarını konteynere aktar
WORKDIR /app
COPY . .

# 4. Laravel paketlerini ve Tailwind/Vite tasarım dosyalarını derle
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# 5. Klasör okuma/yazma izinlerini ayarla
RUN chmod -R 775 storage bootstrap/cache

# 6. Konteyner ayağa kalktığında veritabanını oluştur ve yayına başla
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}