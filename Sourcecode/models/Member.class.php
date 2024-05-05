<?php

class Member extends DB
{
    function getMember()
    {
        // Mendapatkan semua data member dari tabel 'member'
        $query = "SELECT * FROM member";
        return $this->execute($query); // Mengembalikan hasil eksekusi query
    }

    function getMemberID($id)
    {
        // Mendapatkan data member berdasarkan ID tertentu
        $query = "SELECT * FROM member WHERE id = '$id'";
        $this->execute($query); // Eksekusi query
        return $this->getResult(); // Mengembalikan hasil query
    }

    function getMemberJoin(){
        // Mendapatkan data member dengan informasi status keanggotaan yang di-join dengan tabel 'membershipstatus'
        $query ="SELECT
        member.id,
        member.`name`, 
        member.email, 
        member.phone, 
        member.join_date, 
        membershipstatus.status_name
        
    FROM
        member
        INNER JOIN
        membershipstatus
        ON 
            member.status_id = membershipstatus.status_id";
        return $this->execute($query); // Mengembalikan hasil eksekusi query
    }

    function add($data){
        // Menambahkan data member baru ke dalam tabel 'member'
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $status_id = 2; // masih inactive

        // Membuat query untuk menambahkan data ke tabel 'member'
        $query = "INSERT INTO member (name, email, phone, join_date, status_id) VALUES ('$name', '$email', '$phone', '$join_date', '$status_id')";

        // Execute query dan mengembalikan jumlah baris yang terpengaruh
        return $this->executeAffected($query);
    }

    function delete($id){
        // Menghapus data member dari tabel 'member' berdasarkan ID
        $query = "DELETE FROM member WHERE id = '$id'";

        // Eksekusi query dan mengembalikan jumlah baris yang terpengaruh
        return $this->executeAffected($query);
    }

    function update($id, $data)
    {
        // Memperbarui data member di tabel 'member' berdasarkan ID
        $query = "UPDATE member SET ";
        foreach ($data as $key => $value) {
            if ($key !== 'id' && $key !== 'update') { // Mengabaikan kunci 'id' dan 'update'
                $query .= "$key = '$value', ";
            }
        }
        $query = rtrim($query, ", "); // Menghapus koma terakhir
        $query .= " WHERE id = $id";

        // Eksekusi query dan mengembalikan hasilnya
        return $this->execute($query); // Menggunakan execute() karena ingin mengembalikan hasil dari query update
    }

    // Fungsi untuk memperbarui status langganan member
    function updateStatus($member_id){
        // Mendapatkan tanggal saat ini
        $current_date = date('Y-m-d');

        // Memperbarui status keanggotaan member berdasarkan langganan aktif
        $query = "UPDATE member SET status_id = CASE 
            WHEN (SELECT COUNT(*) FROM membershipsubscription WHERE member_id = '$member_id' AND start_date <= '$current_date' AND end_date >= '$current_date') > 0 THEN 1 
            ELSE 2 
            END 
            WHERE id = '$member_id'";
        $this->executeAffected($query); // Eksekusi query
    }

}
