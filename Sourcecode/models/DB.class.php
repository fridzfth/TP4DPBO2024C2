<?php

class DB
{
    var $db_host = ""; // Variabel untuk menyimpan nama host database.
    var $db_user = ""; // Variabel untuk menyimpan nama pengguna database.
    var $db_pass = ""; // Variabel untuk menyimpan kata sandi database.
    var $db_name = ""; // Variabel untuk menyimpan nama database.
    var $db_link = ""; // Variabel untuk menyimpan koneksi ke database.
    var $result = 0;   // Variabel untuk menyimpan hasil query.

    function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        // Constructor untuk kelas DB. Menerima informasi koneksi database.
        $this->db_host = $db_host; // Set nama host database.
        $this->db_user = $db_user; // Set nama pengguna database.
        $this->db_pass = $db_pass; // Set kata sandi database.
        $this->db_name = $db_name; // Set nama database.
    }

    function open()
    {
        // Fungsi untuk membuka koneksi ke database.
        $this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    }

    function execute($query){
        // Fungsi untuk mengeksekusi query pada database.
        $this->result = mysqli_query($this->db_link, $query);
    }

    function getResult()
    {
        // Fungsi untuk mengambil hasil query sebagai array asosiatif.
        return mysqli_fetch_array($this->result);
    }

    function close()
    {
        // Fungsi untuk menutup koneksi ke database.
        mysqli_close($this->db_link);
    }


    function executeAffected($query = "")
    {
        // Fungsi untuk mengeksekusi query yang mempengaruhi database (misalnya, INSERT, UPDATE, DELETE).
        mysqli_query($this->db_link, $query);
        return mysqli_affected_rows($this->db_link); // Mengembalikan jumlah baris yang terpengaruh oleh query.
    }
}

?>
