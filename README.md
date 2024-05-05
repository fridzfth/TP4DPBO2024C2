# TP4DPBO2024C2 - 
**/* Saya Mohammad Faridz Fathin [2202680] mengerjakan TP4 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin. */**

**Desain Program:**

Program ini adalah sebuah aplikasi manajemen keanggotaan yang memungkinkan pengguna untuk mengelola anggota, status keanggotaan, dan langganan. Berikut adalah komponen utama dari program ini:

1. **Kelas-Kelas:**
   - **DB**: Kelas untuk mengatur koneksi ke database.
   - **Member**: Kelas untuk mengelola data anggota.
   - **Status**: Kelas untuk mengelola data status keanggotaan.
   - **Subscription**: Kelas untuk mengelola data langganan.

2. **Kontroler:**
   - **MemberController**: Mengontrol alur bisnis untuk fitur anggota, termasuk menambah, mengedit, dan menghapus anggota.
   - **StatusController**: Mengontrol alur bisnis untuk fitur status keanggotaan, termasuk menambah, mengedit, dan menghapus status.
   - **SubscriptionController**: Mengontrol alur bisnis untuk fitur langganan, termasuk menambah, mengedit, dan menghapus langganan.

3. **Tampilan:**
   - **TemplateView**: Menyediakan template untuk halaman HTML.
   - **MemberView**: Menampilkan data anggota dalam format HTML.
   - **StatusView**: Menampilkan data status keanggotaan dalam format HTML.
   - **SubscriptionView**: Menampilkan data langganan dalam format HTML.

**Penjelasan Alur Bisnis:**

1. **Anggota (Member):**
   - **Menambah Anggota**: Ketika pengguna menambahkan anggota baru melalui halaman "Add Member", data anggota tersebut disimpan dalam database melalui `MemberController`.
   - **Mengedit Anggota**: Ketika pengguna mengedit detail anggota melalui halaman "Edit Member", data yang diperbarui disimpan dalam database melalui `MemberController`.
   - **Menghapus Anggota**: Ketika pengguna menghapus anggota melalui halaman "Delete Member", data anggota tersebut dihapus dari database melalui `MemberController`.

2. **Status Keanggotaan (Status):**
   - **Menambah Status Keanggotaan**: Pengguna dapat menambahkan status keanggotaan baru melalui halaman "Add Status". Data status yang ditambahkan disimpan dalam database melalui `StatusController`.
   - **Mengedit Status Keanggotaan**: Pengguna dapat mengedit detail status keanggotaan melalui halaman "Edit Status". Data yang diperbarui disimpan dalam database melalui `StatusController`.
   - **Menghapus Status Keanggotaan**: Pengguna dapat menghapus status keanggotaan melalui halaman "Delete Status". Data status yang dihapus dari database melalui `StatusController`.

3. **Langganan (Subscription):**
   - **Menambah Langganan**: Pengguna dapat menambahkan langganan baru untuk anggota melalui halaman "Add Subscription". Data langganan yang ditambahkan disimpan dalam database melalui `SubscriptionController`.
   - **Mengedit Langganan**: Pengguna dapat mengedit detail langganan melalui halaman "Edit Subscription". Data yang diperbarui disimpan dalam database melalui `SubscriptionController`.
   - **Menghapus Langganan**: Pengguna dapat menghapus langganan melalui halaman "Delete Subscription". Data langganan yang dihapus dari database melalui `SubscriptionController`.

**Catatan:**
- Setiap kontroler bertanggung jawab untuk memproses permintaan terkait dengan entitas yang sesuai.
- Tampilan bertanggung jawab untuk menampilkan data dalam format yang sesuai dan mengarahkan ke halaman yang tepat berdasarkan permintaan pengguna.
- Kelas DB bertanggung jawab untuk mengatur koneksi ke database.
