# Definisi Lengkap Aljabar Relasional dan Contohnya

Dokumen ini memberikan definisi formal dari operator-operator dasar aljabar relasional, diikuti dengan tabel contoh penerapannya berdasarkan operasi database yang ditemukan dalam dokumen `Basdat5.pdf`.

---

## Definisi Operator Dasar

### 1. **Seleksi (Selection) - `σ`**
Operator Seleksi digunakan untuk menyaring atau memilih *baris* (tupel) dari sebuah relasi (tabel) yang memenuhi suatu kondisi atau predikat tertentu. Hasilnya adalah sebuah relasi baru yang berisi semua baris yang memenuhi kondisi tersebut.

- **Notasi**: `σ`<sub>`kondisi`</sub>(`NamaTabel`)
- **Artinya**: "Pilih semua baris dari `NamaTabel` di mana `kondisi` bernilai benar."

### 2. **Proyeksi (Projection) - `π`**
Operator Proyeksi digunakan untuk memilih *kolom* (atribut) tertentu dari sebuah relasi. Operasi ini akan menghilangkan kolom-kolom lain yang tidak disebutkan. Hasilnya adalah relasi baru dengan jumlah kolom yang lebih sedikit (atau sama).

- **Notasi**: `π`<sub>`kolom1, kolom2, ...`</sub>(`NamaTabel`)
- **Artinya**: "Pilih hanya kolom `kolom1`, `kolom2`, dst. dari `NamaTabel`."

### 3. **Join - `⨝`**
Operator Join digunakan untuk menggabungkan baris dari dua atau lebih relasi berdasarkan suatu kondisi join, biasanya kesamaan nilai pada kolom-kolom yang berelasi.

- **Notasi**: `TabelA` ⨝<sub>`kondisi_join`</sub> `TabelB`
- **Artinya**: "Gabungkan `TabelA` dan `TabelB` menjadi satu tabel baru, di mana setiap baris gabungan terbentuk dari baris di `TabelA` dan `TabelB` yang memenuhi `kondisi_join`."

### 4. **Union (Gabungan) - `∪`**
Operator Union menggabungkan semua baris dari dua relasi yang "kompatibel" (memiliki jumlah dan tipe data kolom yang sama). Duplikat baris secara otomatis akan dihilangkan.

- **Notasi**: `TabelA ∪ TabelB`
- **Artinya**: "Hasilnya adalah sebuah tabel yang berisi semua baris yang ada di `TabelA`, atau di `TabelB`, atau di keduanya." Operasi `INSERT` pada SQL dapat direpresentasikan sebagai Union antara tabel asli dengan sebuah tabel baru yang hanya berisi satu baris data baru.

### 5. **Difference (Selisih) - `-`**
Operator Difference mengambil baris yang ada di relasi pertama tetapi *tidak* ada di relasi kedua. Kedua relasi juga harus kompatibel.

- **Notasi**: `TabelA - TabelB`
- **Artinya**: "Hasilnya adalah tabel yang berisi semua baris yang ada di `TabelA` dan tidak ada di `TabelB`." Operasi `DELETE` pada SQL dapat dilihat sebagai selisih antara tabel asli dengan tabel berisi baris-baris yang akan dihapus.

---

## Tabel Contoh Penerapan

| no | Keterangan & Aljabar Relasional | SQL |
|----|---------------------------------|-----|
| 1  | **User Login**: <br> Memilih ID, nama, dan peran dari pengguna berdasarkan kata sandi. <br> `π`<sub>`IDPengguna, Nama, Role`</sub> (`σ`<sub>`PASSWORD='pass123'`</sub>(`pengguna`)) | `SELECT IDPengguna, Nama, Role FROM pengguna WHERE PASSWORD='pass123';` |
| 2  | **Akses List Game**: <br> Menampilkan daftar game lengkap dengan judul, genre, dan nama platform. <br> `π`<sub>`g.Judul, g.Genre, p.NamaPlatform`</sub> (`game g` ⨝<sub>`g.IDPlatform = p.IDPlatform`</sub> `platform p`) | `SELECT g.Judul, g.Genre, p.NamaPlatform FROM game g JOIN platform p ON g.IDPlatform = p.IDPlatform;` |
| 3  | **Mencari Kaset Tertentu Yang Tersedia**: <br> Mencari ID kaset yang tersedia untuk game dengan ID tertentu. <br> `π`<sub>`IDKaset`</sub> (`σ`<sub>`IDGame='G001' AND Status='tersedia'`</sub>(`kaset`)) | `SELECT IDKaset FROM kaset WHERE IDGame='G001' AND Status='tersedia';` |
| 4  | **Admin: Menampilkan Detail Transaksi Lengkap**: <br> Menampilkan detail lengkap transaksi, termasuk nota, nama pengguna, judul game, status, dan tanggal sewa/kembali. <br> `π`<sub>`t.NomorNota, p.Nama, g.Judul, t.Status, t.TglSewa, t.TglWajibKembali`</sub> (`transaksisewa t` ⨝ `pengguna p` ⨝ `detailsewa dt` ⨝ `kaset ks` ⨝ `game g`) | `SELECT t.NomorNota, p.Nama AS NamaPengguna, g.Judul, t.Status, t.TglSewa, t.TglWajibKembali FROM transaksisewa t JOIN pengguna p ON t.IDPengguna = p.IDPengguna JOIN detailsewa dt ON t.NomorNota = dt.NomorNota JOIN kaset ks ON dt.IDKaset = ks.IDKaset JOIN game g ON ks.IDGame = g.IDGame;` |
| 5  | **Admin: Mengelola Pengguna (Melihat Daftar member)**: <br> Menampilkan ID, nama, email, dan peran dari pengguna yang memiliki peran 'member'. <br> `π`<sub>`IDPengguna, Nama, Email, Role`</sub> (`σ`<sub>`Role='member'`</sub>(`pengguna`)) | `SELECT IDPengguna, Nama, Email, Role FROM pengguna WHERE Role='member';` |
| 6  | **User: Melihat Status Pesanan (Riwayat Sewa)**: <br> Menampilkan riwayat sewa untuk pengguna tertentu, termasuk nomor nota, tanggal sewa, dan judul game yang disewa. <br> `π`<sub>`t.NomorNota, t.TglSewa, g.Judul`</sub> (`σ`<sub>`t.IDPengguna='U001'`</sub> (`transaksisewa t` ⨝ `detailsewa ds` ⨝ `kaset k` ⨝ `game g`)) | `SELECT t.NomorNota, t.TglSewa, g.Judul FROM transaksisewa t JOIN detailsewa ds ON t.NomorNota = ds.NomorNota JOIN kaset k ON ds.IDKaset = k.IDKaset JOIN game g ON k.IDGame = g.IDGame WHERE t.IDPengguna = 'U001';` |
| 7  | **User: Rating game lengkap**: <br> Menampilkan nama pengguna, judul game, skor rating, dan ulasan. <br> `π`<sub>`P.Nama, G.Judul, R.Skor, R.Ulasan`</sub> (`rating R` ⨝<sub>`R.IDPengguna = P.IDPengguna`</sub> `pengguna P` ⨝<sub>`R.IDGame = G.IDGame`</sub> `game G`) | `SELECT P.Nama, G.Judul, R.Skor, R.Ulasan FROM rating R JOIN pengguna P ON R.IDPengguna = P.IDPengguna JOIN game G ON R.IDGame = G.IDGame;` |
| 8  | **User: Game dengan rating rata-rata tertinggi**: <br> Menampilkan judul game dengan rating rata-rata tertinggi. <br> `G`<sub>`Judul`</sub>`F`<sub>`AVG(Skor)`</sub> (`rating R` ⨝<sub>`R.IDGame = G.IDGame`</sub> `game G`) | `SELECT G.Judul, AVG(R.Skor) AS Rata FROM rating R JOIN game G ON R.IDGame = G.IDGame GROUP BY G.Judul ORDER BY Rata DESC LIMIT 1;` |
| 9  | **User: Cari Game berdasarkan Judul**: <br> Mencari semua game yang judulnya mengandung kata kunci tertentu. <br> `σ`<sub>`Judul LIKE '%keyword%'`</sub> (`game`) | `SELECT * FROM game WHERE Judul LIKE '%The Last%';` |
| 10 | **User: Membuat Transaksi Sewa (INSERT)**: <br> Menyisipkan data transaksi sewa baru ke dalam tabel `TransaksiSewa`. <br> `TransaksiSewa` ∪ `{('N005', 3, '2025-01-20', '2025-01-25')}` | `INSERT INTO TransaksiSewa (NomorNota, IDPengguna, TglSewa, TglWajibKembali) VALUES ('N005',3,'2025-01-20','2025-01-25');` |
| 11 | **Admin: Detail Transaksi Lengkap (Lanjutan)**: <br> Menampilkan detail lengkap transaksi, termasuk nota, nama pengguna, judul game, status kaset, dan tanggal sewa/kembali. <br> `π`<sub>`T.NomorNota, P.Nama, G.Judul, K.Status, T.TglSewa, T.TglWajibKembali`</sub> (`transaksisewa T` ⨝ `pengguna P` ⨝ `detailsewa D` ⨝ `kaset K` ⨝ `game G`) | `SELECT T.NomorNota, P.Nama, G.Judul, K.Status, T.TglSewa, T.TglWajibKembali FROM TransaksiSewa AS T JOIN Pengguna AS P ON T.IDPengguna = P.IDPengguna JOIN DetailSewa AS D ON T.NomorNota = D.NomorNota JOIN Kaset AS K ON D.IDKaset = K.IDKaset JOIN Game AS G ON K.IDGame = G.IDGame;` |