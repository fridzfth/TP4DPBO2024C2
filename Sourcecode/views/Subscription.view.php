<?php

class SubscriptionView {
    public function render($data){
        // Inisialisasi variabel
        $no = 1;
        $dataSubscription = null;
        $dataheader = "<tr>
                            <th>ID</th>
                            <th>MEMBER NAME</th>
                            <th>SUBSCRIPTION</th>
                            <th>START DATE</th>
                            <th>END DATE</th>
                            <th>PAYMENT METHOD</th>
                            <th>ACTIONS</th>
                        </tr>";

        // Looping melalui data langganan dan membuat baris-baris tabel HTML
        foreach($data as $val){
            list($id, $nama, $subs, $start, $end, $payment) = $val;
            $dataSubscription .= "<tr>
                                    <td>" . $no++ . "</td>
                                    <td>" . $nama . "</td>
                                    <td>" . $subs . "</td>
                                    <td>" . $start . "</td>
                                    <td>" . $end . "</td>
                                    <td>" . $payment . "</td>
                                    <td>
                                        <a href='subscription.php?editpage=" . $id .  "' class='btn btn-warning'>Edit</a> <!-- Tombol Edit -->
                                        <a href='subscription.php?id_hapus=" . $id . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete?\")'>Hapus</a> <!-- Tombol Hapus -->
                                    </td> 
                                </tr>";
        }

        // Menggunakan kelas Template untuk memuat dan mengganti konten template dengan data yang dihasilkan
        $tpl = new Template("templates/index.html");

        $tpl->replace("DATA_TITLE_PAGE", "SUBSCRIPTION"); // Mengganti judul halaman
        $tpl->replace("DATA_REDIRECT_PHP", "subscription"); // Mengganti URL redirect
        $tpl->replace("DATA_HEADER_PAGE", $dataheader); // Mengganti header tabel
        $tpl->replace("DATA_TABLE_PAGE", $dataSubscription); // Mengganti baris-baris tabel

        $tpl->write(); // Menulis hasil penggantian ke layar
    }

    public function renderadd($data){
        // Membuat formulir tambah langganan dengan menggunakan kelas Template
        $dataform = "<label> MEMBER NAME: </label>
                        <select name='id' class='form-control' required>
                        <option disabled selected>Choose Member</option>";

        // Menambahkan opsi untuk setiap anggota dalam array $data
        foreach($data as $val) {
            list($id, $nama) = $val;
            $dataform .= "<option value='".$id."'>".$nama."</option>";
        }

        // Menutup tag <select> dan melanjutkan dengan elemen formulir berikutnya
        $dataform .= "</select> <br>
                        <label> SUBSCRIPTION TYPE: </label>
                        <select name='type' class='form-control' required>
                        <option disabled selected>Choose Subscription Type</option>
                            <option value='Basic'>Basic</option>
                            <option value='Plus'>Plus</option>
                            <option value='Platinum'>Platinum</option>
                        </select> <br>
                        
                        <label> START DATE: </label>
                        <input type='date' name='start_date' class='form-control' required> <br>

                        <label> END DATE: </label>
                        <input type='date' name='end_date' class='form-control' required> <br>
                        
                        <label> PAYMENT METHOD: </label>
                        <select name='payment' class='form-control' required>
                        <option disabled selected>Choose Paymet Method</option>
                            <option value='Credit Card'>Credit Card</option>
                            <option value='PayPal'>PayPal</option>
                            <option value='Bank Transfer'>Bank Transfer</option>
                        </select> <br>";

        // Menggunakan kelas Template untuk memuat dan mengganti konten template dengan formulir yang dihasilkan
        $tpl = new Template("templates/skinform.html");

        $tpl->replace("DATA_TITLE_PAGE", "ADD SUBSCRIPTION"); // Mengganti judul halaman
        $tpl->replace("DATA_REDIRECT_PHP", "subscription"); // Mengganti URL redirect
        $tpl->replace("DATA_NAME_PAGE", "TAMBAH SUBSCRIPTION"); // Mengganti label halaman
        $tpl->replace("DATA_FORM_PAGE", $dataform); // Menyisipkan formulir
        $tpl->replace("DATA_BUTTON", "add"); // Mengganti teks tombol
        $tpl->replace("DATA_PAGE_STYLE", "primary"); // Mengganti warna halaman

        $tpl->write(); // Menulis hasil penggantian ke layar
    }

    public function renderedit($data, $member){
        // Mendapatkan nilai-nilai dari array $data
        $subscription_id = $data[0];
        $member_id = $data[1];
        $subscription_type = $data[2];
        $start_date = $data[3];
        $end_date = $data[4];
        $payment_method = $data[5];

        // Membuat formulir edit langganan dengan menggunakan kelas Template
        $dataform = "<input type='hidden' name='subscription_id' value='" . $subscription_id . "'>
                        <label> MEMBER NAME: </label>
                        <select name='member_id' class='form-control' required>
                        <option disabled selected>Choose Member</option>";

        // Menambahkan opsi untuk setiap anggota dalam array $member
        foreach($member as $val) {
            list($id, $nama) = $val;
            $selected = ($id == $member_id) ? "selected" : ""; // Menandai anggota yang cocok sebagai terpilih
            $dataform .= "<option value='".$id."' ".$selected.">".$nama."</option>";
        }

        // Menutup tag <select> dan melanjutkan dengan elemen formulir berikutnya
        $dataform .= "</select> <br>
                        <label> SUBSCRIPTION TYPE: </label>
                        <select name='subscription_type' class='form-control' required>
                        <option disabled selected>Choose Subscription Type</option>
                            <option value='Basic' ".($subscription_type == 'Basic' ? 'selected' : '').">Basic</option>
                            <option value='Plus' ".($subscription_type == 'Plus' ? 'selected' : '').">Plus</option>
                            <option value='Platinum' ".($subscription_type == 'Platinum' ? 'selected' : '').">Platinum</option>
                        </select> <br>
                        
                        <label> START DATE: </label>
                        <input type='date' name='start_date' class='form-control' value='" . $start_date . "' required> <br>

                        <label> END DATE: </label>
                        <input type='date' name='end_date' class='form-control' value='" . $end_date . "' required> <br>
                        
                        <label> PAYMENT METHOD: </label>
                        <select name='payment_method' class='form-control' required>
                        <option disabled selected>Choose Payment Method</option>
                            <option value='Credit Card' ".($payment_method == 'Credit Card' ? 'selected' : '').">Credit Card</option>
                            <option value='PayPal' ".($payment_method == 'PayPal' ? 'selected' : '').">PayPal</option>
                            <option value='Bank Transfer' ".($payment_method == 'Bank Transfer' ? 'selected' : '').">Bank Transfer</option>
                        </select> <br>";

        // Menggunakan kelas Template untuk memuat dan mengganti konten template dengan formulir yang dihasilkan
        $tpl = new Template("templates/skinform.html");

        $tpl->replace("DATA_TITLE_PAGE", "EDIT SUBSCRIPTION"); // Mengganti judul halaman
        $tpl->replace("DATA_REDIRECT_PHP", "subscription"); // Mengganti URL redirect
        $tpl->replace("DATA_NAME_PAGE", "EDIT SUBSCRIPTION"); // Mengganti label halaman
        $tpl->replace("DATA_FORM_PAGE", $dataform); // Menyisipkan formulir
        $tpl->replace("DATA_BUTTON", "update"); // Mengganti teks tombol
        $tpl->replace("DATA_PAGE_STYLE", "warning"); // Mengganti warna halaman

        $tpl->write(); // Menulis hasil penggantian ke layar
    }
}

?>
