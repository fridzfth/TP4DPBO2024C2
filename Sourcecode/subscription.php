<?php
// Mengimpor kelas yang diperlukan
include_once("views/Template.view.php");
include_once("models/DB.class.php");
include_once("controllers/Subscription.controller.php");

// Membuat objek dari kelas SubscriptionController
$subscription = new SubscriptionController();

// Memeriksa apakah parameter 'editpage' ada dalam URL
if (!empty($_GET['editpage'])) {
    // Jika ya, ambil ID dari URL dan panggil method editpage dari SubscriptionController
    $id = $_GET['editpage'];
    $subscription->editpage($id);
} 
// Memeriksa apakah parameter 'addpage' ada dalam URL
else if (!empty($_GET['addpage'])) {
    // Jika ya, panggil method addpage dari SubscriptionController
    $subscription->addpage();
} 
// Memeriksa apakah parameter 'id_hapus' ada dalam URL
else if (!empty($_GET['id_hapus'])) {
    // Jika ya, ambil ID dari URL dan panggil method delete dari SubscriptionController
    $id = $_GET['id_hapus'];
    $subscription->delete($id);
} 
// Memeriksa apakah tombol 'update' telah dikirimkan melalui metode POST
else if (isset($_POST['update'])) {
    // Jika ya, panggil method edit dari SubscriptionController dengan data dari form
    $subscription->edit($_POST);
} 
// Memeriksa apakah tombol 'add' telah dikirimkan melalui metode POST
else if(isset($_POST['add'])) {
    // Jika ya, panggil method add dari SubscriptionController dengan data dari form
    $subscription->add($_POST);
} 
// Jika tidak ada parameter yang diberikan, tampilkan halaman indeks untuk subscription
else {
    $subscription->index();
}
?>
