# Setup Socket.IO Realtime di Laravel

1. **Install Laravel Echo Server**
   ```bash
   npm install -g laravel-echo-server
   ```

2. **Konfigurasi Broadcasting Laravel**
   - Di `.env`:
     ```
     BROADCAST_DRIVER=redis
     ```
   - Di `config/broadcasting.php` pastikan default: `redis`.

3. **Konfigurasi Laravel Echo Server**
   - Jalankan:
     ```
     laravel-echo-server init
     ```
   - Jawab pertanyaan, pastikan port sesuai (default 6001).

4. **Jalankan Redis**
   - Redis harus berjalan (bisa pakai `docker`, `brew`, atau installer).

5. **Jalankan Laravel Echo Server**
   ```bash
   laravel-echo-server start
   ```

6. **Jalankan Queue Worker Laravel**
   ```bash
   php artisan queue:work
   ```

7. **Frontend**
   - Sudah benar: gunakan `window.io = io;` dan koneksi ke `http://localhost:6001` di browser.

8. **Backend**
   - Gunakan event Laravel yang mengimplementasikan `ShouldBroadcast`.
   - Contoh event: `DashboardTaxUpdate` (lihat jawaban sebelumnya).

9. **Cek Firewall/Port**
   - Pastikan port 6001 terbuka di server/development.

10. **Cek Konsol**
    - Jika tidak realtime, cek error di browser dan terminal `laravel-echo-server`.

---

**Catatan:**  
- Tidak perlu Pusher, cukup Redis + Laravel Echo Server + Socket.IO client.
- Untuk production, pastikan keamanan port dan environment.

