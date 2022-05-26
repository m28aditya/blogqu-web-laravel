1. Download Source Code
2. jalankan "composer install"
3. jalankan "cp .env.example .env"
4. Jalankan php artisan key:generate
5. Tambahkan FILESYSTEM_DRIVER=public pada .env
6. Jalankan php artisan storage:link 
7. Buat Database dan sambungkan pada .env
8. jalankan php artisan migrate
9. selesai
