<?php

class Status extends DB
{
    function getStatus()
    {
        // Mendapatkan semua data status keanggotaan dari tabel 'membershipstatus'
        $query = "SELECT * FROM membershipstatus"; 
        return $this->execute($query); // Mengembalikan hasil eksekusi query
    }

    function getStatusID($id){
        // Mendapatkan data status keanggotaan berdasarkan ID tertentu
        $query = "SELECT * FROM membershipstatus WHERE status_id = '$id'";
        $this->execute($query); // Eksekusi query
        return $this->getResult(); // Mengembalikan hasil query
    }

    function add($data){
        // Menambahkan data status keanggotaan baru ke dalam tabel 'membershipstatus'
        $status_name = $data['name']; // Mengambil nama status dari data yang diberikan
        $description = $data['desc']; // Mengambil deskripsi dari data yang diberikan

        // Membuat query untuk menambahkan data ke tabel 'membershipstatus'
        $query = "INSERT INTO membershipstatus (status_name, description) VALUES ('$status_name', '$description')";

        // Execute query dan mengembalikan jumlah baris yang terpengaruh
        return $this->executeAffected($query);
    }

    function delete($id)
    {
        // Menghapus data status keanggotaan dari tabel 'membershipstatus' berdasarkan ID
        $query = "DELETE FROM membershipstatus WHERE status_id = '$id'";

        // Eksekusi query dan mengembalikan jumlah baris yang terpengaruh
        return $this->executeAffected($query);
    }

    function update($id, $data){
        // Memperbarui data status keanggotaan di tabel 'membershipstatus' berdasarkan ID
        $query = "UPDATE membershipstatus SET ";
        foreach ($data as $key => $value) {
            if ($key !== 'update') { // Mengabaikan kunci 'id' dan 'update'
                $query .= "$key = '$value', ";
            }
        }
        $query = rtrim($query, ", "); // Menghapus koma terakhir
        $query .= " WHERE status_id = $id";

        // Eksekusi query dan mengembalikan hasilnya
        return $this->execute($query); // Menggunakan execute() karena ingin mengembalikan hasil dari query update
    }
}
