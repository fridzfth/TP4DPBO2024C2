<?php
include_once("conf.php"); // Memasukkan file konfigurasi untuk koneksi database
include_once("models/Status.class.php"); // Memasukkan kelas Status
include_once("views/Status.view.php"); // Memasukkan kelas view Status

class StatusController{
    private $status; // Objek untuk mengakses data status

    function __construct() {
        // Konstruktor, membuat instance dari kelas Status
        $this->status = new Status(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index() {
        // Menampilkan halaman utama dengan daftar status keanggotaan
        $this->status->open();
        $this->status->getStatus(); // Mendapatkan data status keanggotaan

        $data = array();
        while($row = $this->status->getResult()){
          array_push($data, $row);
        }
    
        $this->status->close(); // Menutup koneksi database setelah mendapatkan data
    
        $view = new StatusView(); // Membuat instance dari kelas view Status
        $view->render($data); // Menampilkan halaman dengan data yang diperoleh
      }
    
      function addpage(){
        // Menampilkan halaman tambah status keanggotaan
        $view = new StatusView();
        $view->renderadd();
      }


      function add($data){
        // Menambahkan status keanggotaan baru ke dalam database
        $this->status->open();
        $this->status->add($data); // Memanggil fungsi untuk menambahkan status keanggotaan baru
        $this->status->close(); // Menutup koneksi database
        
        header("location:status.php"); // Mengarahkan kembali ke halaman status setelah menambahkan status baru
      }

      function editpage($id){
        // Menampilkan halaman edit status keanggotaan dengan informasi status yang akan diedit
        $this->status->open();
        $data  = $this->status->getStatusID($id); // Mendapatkan data status berdasarkan ID
        $this->status->close(); // Menutup koneksi database setelah mendapatkan data

        $view = new StatusView();
        $view->renderedit($data); // Menampilkan halaman edit dengan data yang diperoleh
        
      }
    
      function edit($data){
        // Memperbarui data status keanggotaan
        $id = $data['status_id']; // Mengambil ID dari formulir
        unset($data['status_id']); // Menghapus kunci 'id' dari data yang akan diupdate

        
        $this->status->open();
        $this->status->update($id,$data); // Memanggil fungsi update dengan data yang tepat
        $this->status->close(); // Menutup koneksi database
        
        header("location:status.php"); // Mengarahkan kembali ke halaman status setelah mengupdate status
      }
    
      function delete($id){
        // Menghapus status keanggotaan dari database
        $this->status->open();
        $this->status->delete($id); // Menghapus status berdasarkan ID
        $this->status->close(); // Menutup koneksi database
        
        header("location:status.php"); // Mengarahkan kembali ke halaman status setelah menghapus status
      }
    
}
