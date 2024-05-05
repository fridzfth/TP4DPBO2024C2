<?php
// Mengimpor kelas yang diperlukan
include_once("views/Template.view.php");
include_once("models/DB.class.php");
include_once("controllers/Member.controller.php");

// Membuat objek dari kelas MemberController
$member = new MemberController();

// Memeriksa apakah parameter 'editpage' ada dalam URL
if (!empty($_GET['editpage'])) {
    // Jika ya, ambil ID dari URL dan panggil method editpage dari MemberController
    $id = $_GET['editpage'];
    $member->editpage($id);
} 
// Memeriksa apakah parameter 'addpage' ada dalam URL
else if (!empty($_GET['addpage'])) {
    // Jika ya, panggil method addpage dari MemberController
    $member->addpage();
} 
// Memeriksa apakah parameter 'id_hapus' ada dalam URL
else if (!empty($_GET['id_hapus'])) {
    // Jika ya, ambil ID dari URL dan panggil method delete dari MemberController
    $id = $_GET['id_hapus'];
    $member->delete($id);
} 
// Memeriksa apakah tombol 'update' telah dikirimkan melalui metode POST
else if (isset($_POST['update'])) {
    // Jika ya, panggil method edit dari MemberController dengan data dari form
    $member->edit($_POST);
} 
// Memeriksa apakah tombol 'add' telah dikirimkan melalui metode POST
else if(isset($_POST['add'])) {
    // Jika ya, panggil method add dari MemberController dengan data dari form
    $member->add($_POST);
} 
// Jika tidak ada parameter yang diberikan, tampilkan halaman indeks untuk member
else{
    $member->index();
}
?>
