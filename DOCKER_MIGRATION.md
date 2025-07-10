# Cara Migration Ulang di Docker (Laravel)

1. Jalankan migrate:fresh **tanpa masuk ke bash** dengan perintah berikut dari host (di luar container):

   ```bash
   docker compose exec app php artisan migrate:fresh
   ```

   atau jika servicenya bernama `laravel`:

   ```bash
   docker compose exec laravel php artisan migrate:fresh
   ```

2. Untuk migrate dan seeding sekaligus:

   ```bash
   docker compose exec app php artisan migrate:fresh --seed
   ```

3. Jika menggunakan Docker Compose versi lama, bisa juga:

   ```bash
   docker-compose exec app php artisan migrate:fresh
   ```

**Catatan:**
- Pastikan service container sudah berjalan (`docker compose up -d`).
- Tidak perlu masuk ke bash/container, cukup jalankan perintah di atas dari terminal host.
- Semua data di database akan hilang jika menggunakan `migrate:fresh`.
