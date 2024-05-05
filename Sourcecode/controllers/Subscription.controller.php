<?php
include_once("conf.php"); // Memasukkan file konfigurasi untuk koneksi database
include_once("models/Subscription.class.php"); // Memasukkan kelas Subscription
include_once("models/Member.class.php"); // Memasukkan kelas Member
include_once("views/Subscription.view.php"); // Memasukkan kelas view Subscription

class SubscriptionController{
    private $subscription; // Objek untuk mengakses data langganan
    private $member; // Objek untuk mengakses data member

    function __construct() {
        // Konstruktor, membuat instance dari kelas Subscription dan Member
        $this->subscription = new Subscription(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->member = new Member(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index() {
        // Menampilkan halaman utama dengan daftar langganan yang di-join dengan informasi member
        $this->subscription->open();
        $this->subscription->getSubscriptionJoin(); // Mendapatkan data langganan yang di-join dengan informasi member
        
        $data = array();
        while($row = $this->subscription->getResult()){
          array_push($data, $row);
        }
        
        $this->subscription->close(); // Menutup koneksi database setelah mendapatkan data
    
        $view = new SubscriptionView(); // Membuat instance dari kelas view Subscription
        $view->render($data); // Menampilkan halaman dengan data yang diperoleh
      }
    
      function addpage(){
        // Menampilkan halaman tambah langganan dengan pilihan member yang tersedia
        $this->member->open();
        $this->member->getMember(); // Mendapatkan data member
        $data = array();
        while($row = $this->member->getResult()){
          array_push($data, $row);
        }
        $this->member->close(); // Menutup koneksi database setelah mendapatkan data
        $view = new SubscriptionView();
        $view->renderadd($data); // Menampilkan halaman tambah dengan data member yang tersedia
      }
      
      function add($data){
        // Menambahkan langganan baru ke dalam database dan memperbarui status keanggotaan member
        $this->subscription->open();
        $this->member->open();
        $this->subscription->add($data); // Memanggil fungsi untuk menambahkan langganan baru
        $id = $data['id'];
        $this->member->updateStatus($id); // Memperbarui status keanggotaan member
        $this->subscription->close();
        $this->member->close();
        header("location:subscription.php"); // Mengarahkan kembali ke halaman langganan setelah menambahkan langganan baru
      }

      function editpage($id){
        // Menampilkan halaman edit langganan dengan informasi langganan yang akan diedit dan pilihan member yang tersedia
        $this->member->open();
        $this->subscription->open();
        $this->member->getMember(); // Mendapatkan data member
        $data = $this->subscription->getSubsID($id); // Mendapatkan data langganan berdasarkan ID
        $data_member = array();
        while($row = $this->member->getResult()){
          array_push($data_member, $row);
        }
        $this->member->close();
        $this->subscription->close();

        $view = new SubscriptionView();
        $view->renderedit($data, $data_member); // Menampilkan halaman edit dengan data yang diperoleh
        
      }
    
      function edit($data){
        // Memperbarui data langganan dan memperbarui status keanggotaan member terkait
        $id = $data['subscription_id']; // Mengambil ID dari formulir
        unset($data['subscription_id']); // Menghapus kunci 'id' dari data yang akan diupdate

        $this->subscription->open();
        $this->member->open();
        $id_member = $this->subscription->getMemberId($id); // Mendapatkan ID member terkait langganan
        $this->subscription->update($id, $data); // Memanggil fungsi update dengan data yang tepat
        $this->member->updateStatus($id_member); // Memperbarui status keanggotaan member terkait
        $this->subscription->close();
        $this->member->close();
        
        header("location:subscription.php"); // Mengarahkan kembali ke halaman langganan setelah mengupdate langganan
      }
    
      function delete($id){
        // Menghapus langganan dan memperbarui status keanggotaan member terkait
        $this->subscription->open();
        $this->member->open();
        $id_member = $this->subscription->getMemberId($id); // Mendapatkan ID member terkait langganan
        $this->subscription->delete($id); // Menghapus langganan berdasarkan ID
        $this->member->updateStatus($id_member); // Memperbarui status keanggotaan member terkait
        $this->subscription->close();
        $this->member->close();
        
        header("location:subscription.php"); // Mengarahkan kembali ke halaman langganan setelah menghapus langganan
      }
    
}
