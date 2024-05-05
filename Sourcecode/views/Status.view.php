<?php

class StatusView {
    public function render($data){
        // Inisialisasi variabel
        $no = 1;
        $dataStatus = null;
        $dataheader = "<tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>DESCRIPTION</th>
                            <th>ACTIONS</th>
                        </tr>";

        // Looping melalui data status dan membuat baris-baris tabel HTML
        foreach($data as $val){
            list($id, $nama, $description) = $val;
            $dataStatus .= "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $nama . "</td>
                                <td>" . $description . "</td>
                                <td>
                                    <a href='status.php?editpage=" . $id .  "' class='btn btn-warning'>Edit</a> <!-- Tombol Edit -->
                                    <a href='status.php?id_hapus=" . $id . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete?\")'>Hapus</a> <!-- Tombol Hapus -->
                                </td> 
                            </tr>";
        }

        // Menggunakan kelas Template untuk memuat dan mengganti konten template dengan data yang dihasilkan
        $tpl = new Template("templates/index.html");

        $tpl->replace("DATA_TITLE_PAGE", "STATUS"); // Mengganti judul halaman
        $tpl->replace("DATA_REDIRECT_PHP", "status"); // Mengganti URL redirect
        $tpl->replace("DATA_HEADER_PAGE", $dataheader); // Mengganti header tabel
        $tpl->replace("DATA_TABLE_PAGE", $dataStatus); // Mengganti baris-baris tabel

        $tpl->write(); // Menulis hasil penggantian ke layar
    }

    public function renderadd(){
        // Membuat formulir tambah status dengan menggunakan kelas Template
        $dataform = "
            <label> NAME: </label>
            <input type='text' name='name' class='form-control' required> <br>
            
            <label> DESCRIPTION: </label>
            <textarea name='desc' class='form-control' required></textarea> <br>";

        // Menggunakan kelas Template untuk memuat dan mengganti konten template dengan formulir yang dihasilkan
        $tpl = new Template("templates/skinform.html");

        $tpl->replace("DATA_TITLE_PAGE", "ADD STATUS"); // Mengganti judul halaman
        $tpl->replace("DATA_REDIRECT_PHP", "status"); // Mengganti URL redirect
        $tpl->replace("DATA_NAME_PAGE", "TAMBAH STATUS"); // Mengganti label halaman
        $tpl->replace("DATA_FORM_PAGE", $dataform); // Menyisipkan formulir
        $tpl->replace("DATA_BUTTON", "add"); // Mengganti teks tombol
        $tpl->replace("DATA_PAGE_STYLE", "primary"); // Mengganti warna halaman

        $tpl->write(); // Menulis hasil penggantian ke layar
    }

    public function renderedit($data){
        // Mendapatkan nilai-nilai dari array $data
        $id = $data[0];
        $nama = $data[1];
        $desc = $data[2];
    
        // Membuat formulir edit status dengan menggunakan kelas Template
        $dataform = "
            <input type='hidden' name='status_id' value='" . $id . "'>
            <label> NAME: </label>
            <input type='text' name='status_name' class='form-control' value='" . $nama . "' required> <br>
            
            <label> DESCRIPTION: </label>
            <textarea name='description' class='form-control' required>" . $desc . "</textarea> <br>";
    
        // Menggunakan kelas Template untuk memuat dan mengganti konten template dengan formulir yang dihasilkan
        $tpl = new Template("templates/skinform.html");
    
        $tpl->replace("DATA_TITLE_PAGE", "EDIT STATUS"); // Mengganti judul halaman
        $tpl->replace("DATA_REDIRECT_PHP", "status"); // Mengganti URL redirect
        $tpl->replace("DATA_NAME_PAGE", "EDIT STATUS"); // Mengganti label halaman
        $tpl->replace("DATA_FORM_PAGE", $dataform); // Menyisipkan formulir
        $tpl->replace("DATA_BUTTON", "update"); // Mengganti teks tombol
        $tpl->replace("DATA_PAGE_STYLE", "warning"); // Mengganti warna halaman
    
        $tpl->write(); // Menulis hasil penggantian ke layar
    }
}

?>
