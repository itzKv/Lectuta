Sehabis pull, jalankan command berikut di terminal:
1. php artisan package:discover --ansi
2. php artisan vendor:publish --tag=laravel-assets --ansi --force
3. php artisan key:generate --ansi
4. php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
5. php artisan migrate --graceful --ansi
6. php artisan serve
7. uncomment file .gitignore