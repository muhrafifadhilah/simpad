# Cara Install Laravel Echo Server

1. Install Laravel Echo Server secara global:
   ```bash
   npm install -g laravel-echo-server
   ```

2. Inisialisasi file konfigurasi:
   ```bash
   laravel-echo-server init
   ```

   Ikuti instruksi, sesuaikan port (6001), host, dan driver Redis.

3. Jalankan Laravel Echo Server:
   ```bash
   laravel-echo-server start
   ```

4. Pastikan Redis sudah berjalan.

5. Pastikan `.env` sudah:
   ```
   BROADCAST_DRIVER=redis
   QUEUE_CONNECTION=redis
   LARAVEL_ECHO_SERVER_PORT=6001
   ```

6. Untuk development, jalankan Echo Server bersamaan dengan Laravel.

**Catatan:**  
- Untuk Docker, expose port 6001 di docker-compose.
- Untuk dokumentasi lebih lanjut: https://github.com/tlaverdure/laravel-echo-server
