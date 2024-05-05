<?php
// Mengimpor kelas yang diperlukan
include_once("views/Template.view.php");
include_once("models/DB.class.php");
include_once("controllers/Status.controller.php");

// Membuat objek dari kelas StatusController
$status = new StatusController();

// Memeriksa apakah parameter 'editpage' ada dalam URL
if (!empty($_GET['editpage'])) {
    // Jika ya, ambil ID dari URL dan panggil method editpage dari StatusController
    $id = $_GET['editpage'];
    $status->editpage($id);
} 
// Memeriksa apakah parameter 'addpage' ada dalam URL
else if (!empty($_GET['addpage'])) {
    // Jika ya, panggil method addpage dari StatusController
    $status->addpage();
} 
// Memeriksa apakah parameter 'id_hapus' ada dalam URL
else if (!empty($_GET['id_hapus'])) {
    // Jika ya, ambil ID dari URL dan panggil method delete dari StatusController
    $id = $_GET['id_hapus'];
    $status->delete($id);
} 
// Memeriksa apakah tombol 'update' telah dikirimkan melalui metode POST
else if (isset($_POST['update'])) {
    // Jika ya, panggil method edit dari StatusController dengan data dari form
    $status->edit($_POST);
} 
// Memeriksa apakah tombol 'add' telah dikirimkan melalui metode POST
else if(isset($_POST['add'])) {
    // Jika ya, panggil method add dari StatusController dengan data dari form
    $status->add($_POST);
} 
// Jika tidak ada parameter yang diberikan, tampilkan halaman indeks untuk status
else {
    $status->index();
}
?>
