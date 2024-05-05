<?php
include_once("conf.php"); // Memasukkan file konfigurasi untuk koneksi database
include_once("models/Member.class.php"); // Memasukkan kelas Member
include_once("models/Subscription.class.php"); // Memasukkan kelas Subscription
include_once("models/Status.class.php"); // Memasukkan kelas Status
include_once("views/Member.view.php"); // Memasukkan kelas view Member

class MemberController{
    private $member; // Objek untuk mengakses data member
    private $subs; // Objek untuk mengakses data langganan
    private $state; // Objek untuk mengakses data status keanggotaan

    function __construct() {
        // Konstruktor, membuat instance dari kelas Member, Subscription, dan Status
        $this->member = new Member(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->subs = new Subscription(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->state = new Status(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index() {
        // Menampilkan halaman utama dengan daftar member yang bergabung dengan status keanggotaan
        $this->member->open();
        $this->member->getMemberJoin(); // Mendapatkan data member yang di-join dengan status keanggotaan

        $data = array();
        while($row = $this->member->getResult()){
          array_push($data, $row);
        }
    
        $this->member->close(); // Menutup koneksi database setelah mendapatkan data

        $view = new MemberView(); // Membuat instance dari kelas view Member
        $view->render($data); // Menampilkan halaman dengan data yang diperoleh
      }
    
      function addpage(){
        // Menampilkan halaman tambah member
        $view = new MemberView();
        $view->renderadd();
      }

      function add($data){
        // Menambahkan member baru ke dalam database
        $this->member->open();
        $this->member->add($data); // Memanggil fungsi untuk menambahkan member baru
        $this->member->close(); // Menutup koneksi database
        header("location:index.php"); // Mengarahkan kembali ke halaman utama setelah menambahkan member
    }

    function editpage($id){
      // Menampilkan halaman edit member dengan informasi member dan status keanggotaan
      $this->member->open();
      $this->state->open();
      $this->state->getStatus(); // Mendapatkan data status keanggotaan

      $data = $this->member->getMemberID($id); // Mendapatkan data member berdasarkan ID
      $state = array();
      while($row = $this->state->getResult()){
        array_push($state, $row);
      }

      $this->member->close(); // Menutup koneksi database setelah mendapatkan data member
      $this->state->close(); // Menutup koneksi database setelah mendapatkan data status keanggotaan
      $view = new MemberView();

      $view->renderedit($data, $state); // Menampilkan halaman edit dengan data yang diperoleh
      
    }
    
      function edit($data){
        // Memperbarui data member
        $id = $data['id']; // Mengambil ID dari formulir
        unset($data['id']); // Menghapus kunci 'id' dari data yang akan diupdate

        $this->member->open();
        $this->member->update($id,$data); // Memanggil fungsi update dengan data yang tepat
        $this->member->close(); // Menutup koneksi database
        
        header("location:index.php"); // Mengarahkan kembali ke halaman utama setelah mengupdate member
      }
    
      function delete($id){
        // Menghapus member dan langganan yang terkait
        $this->member->open();
        $this->subs->open();
        $this->member->delete($id); // Menghapus member berdasarkan ID
        $this->subs->deleteByMemberId($id); // Menghapus langganan berdasarkan ID member
        $this->member->close(); // Menutup koneksi database
        $this->subs->close(); // Menutup koneksi database
        
        header("location:index.php"); // Mengarahkan kembali ke halaman utama setelah menghapus member
      }
}
