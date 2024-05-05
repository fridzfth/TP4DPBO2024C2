<?php

class MemberView {
  public function render($data){
    // Menginisialisasi variabel-variabel untuk tabel data
    $no = 1;
    $dataMember = null;
    $dataheader = "<tr>
                      <th>ID</th>
                      <th>NAME</th>
                      <th>EMAIL</th>
                      <th>PHONE</th>
                      <th>JOINING DATE</th>
                      <th>STATE</th>
                      <th>ACTIONS</th>
                  </tr>";

    // Mendapatkan data anggota dan memformatnya menjadi baris-baris tabel HTML
    foreach($data as $val){
        list($id, $nama, $email, $phone, $join, $state) = $val;
        $dataMember .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $nama . "</td>
                <td>" . $email . "</td>
                <td>" . $phone . "</td>
                <td>" . $join . "</td>
                <td>" . $state . "</td>
                <td>
                  <a href='index.php?editpage=" . $id .  "' class='btn btn-warning'>Edit</a> <!-- Tombol Edit -->
                  <a href='index.php?id_hapus=" . $id . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete?\")'>Hapus</a> <!-- Tombol Hapus -->
                </td> 
                </tr>";
      }

    // Menggunakan kelas Template untuk memuat dan mengganti konten template dengan data yang dihasilkan
    $tpl = new Template("templates/index.html");

    $tpl->replace("DATA_TITLE_PAGE", "HOME - MEMBER"); // Mengganti judul halaman
    $tpl->replace("DATA_REDIRECT_PHP", "index"); // Mengganti URL redirect
    $tpl->replace("DATA_HEADER_PAGE", $dataheader); // Mengganti header tabel
    $tpl->replace("DATA_TABLE_PAGE", $dataMember); // Mengganti baris-baris tabel

    $tpl->write(); // Menulis hasil penggantian ke layar
  }

  public function renderadd(){
    // Membuat formulir tambah member dengan menggunakan kelas Template
    $dataform = "
    <label> NAME: </label>
    <input type='text' name='name' class='form-control' required> <br>
    
    <label> EMAIL: </label>
    <input type='email' name='email' class='form-control' required> <br>
    
    <label> PHONE: </label>
    <input type='text' name='phone' class='form-control' required> <br>
    
    <label> JOINING DATE: </label>
    <input type='date' name='join_date' class='form-control' required> <br>";
    
    // Menggunakan kelas Template untuk memuat dan mengganti konten template dengan formulir yang dihasilkan
    $tpl = new Template("templates/skinform.html");

    $tpl->replace("DATA_TITLE_PAGE", "ADD MEMBER"); // Mengganti judul halaman
    $tpl->replace("DATA_REDIRECT_PHP", "index"); // Mengganti URL redirect
    $tpl->replace("DATA_NAME_PAGE", "TAMBAH MEMBER"); // Mengganti label halaman
    $tpl->replace("DATA_FORM_PAGE", $dataform); // Menyisipkan formulir
    $tpl->replace("DATA_PAGE_STYLE", "primary"); // Mengganti warna halaman
    $tpl->replace("DATA_BUTTON", "add"); // Mengganti teks tombol

    $tpl->write(); // Menulis hasil penggantian ke layar
  }

  public function renderedit($data, $status) {
    // Mendapatkan nilai-nilai dari array $data
    $id = $data[0];
    $nama = $data[1];
    $email = $data[2];
    $phone = $data[3];
    $state = $data[5]; // State ID
    $join = $data[4];

    // Menginisialisasi variabel $dataform dengan elemen-elemen awal
    $dataform = "
    <input type='hidden' name='id' value='" . $id . "'>
    <label> NAME: </label>
    <input type='text' name='name' class='form-control' value='" . $nama . "' required> <br>

    <label> EMAIL: </label>
    <input type='email' name='email' class='form-control' value='" . $email . "' required> <br>

    <label> PHONE: </label>
    <input type='text' name='phone' class='form-control' value='" . $phone . "' required> <br>

    <label> JOINING DATE: </label>
    <input type='date' name='join_date' class='form-control' value='" . $join . "' required> <br>

    <label> STATE: </label>
    <select name='status_id' class='form-control' required>
    <option disabled selected>Choose Member State</option>";

    // Menambahkan opsi untuk setiap status dalam array $status
    foreach($status as $val) {
        list($state_id, $state_name) = $val;
        $selected = ($state_id == $state) ? "selected" : ""; // Menandai status yang cocok sebagai terpilih
        $dataform .= "<option value='".$state_id."' ".$selected.">".$state_name."</option>";
    }

    // Menutup tag <select> dan menambahkan elemen-elemen terakhir
    $dataform .= "</select> <br>";

    // Melanjutkan dengan penggantian data dalam template dan menuliskan hasilnya
    $tpl = new Template("templates/skinform.html");
    $tpl->replace("DATA_TITLE_PAGE", "EDIT MEMBER"); // Mengganti judul halaman
    $tpl->replace("DATA_REDIRECT_PHP", "index"); // Mengganti URL redirect
    $tpl->replace("DATA_NAME_PAGE", "UPDATE MEMBER"); // Mengganti label halaman
    $tpl->replace("DATA_FORM_PAGE", $dataform); // Menyisipkan formulir
    $tpl->replace("DATA_PAGE_STYLE", "warning"); // Mengganti warna halaman
    $tpl->replace("DATA_BUTTON", "update"); // Mengganti teks tombol
    $tpl->write(); // Menulis hasil penggantian ke layar
}

}

?>
