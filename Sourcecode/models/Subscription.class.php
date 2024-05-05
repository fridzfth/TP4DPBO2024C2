<?php

class Subscription extends DB
{
    // Fungsi untuk mendapatkan semua langganan dari tabel 'membershipsubscription'
    function getSubscription()
    {
        $query = "SELECT * FROM membershipsubscription";
        return $this->execute($query); // Mengembalikan hasil eksekusi query
    }

    // Fungsi untuk mendapatkan semua langganan dengan informasi member yang di-join dengan tabel 'member'
    function getSubscriptionJoin()
    {
        $query = "SELECT
        membershipsubscription.subscription_id, 
        member.`name`, 
        membershipsubscription.subscription_type, 
        membershipsubscription.start_date, 
        membershipsubscription.end_date, 
        membershipsubscription.payment_method
        FROM
        member
        INNER JOIN
        membershipsubscription
        ON 
            member.id = membershipsubscription.member_id";
        return $this->execute($query); // Mengembalikan hasil eksekusi query
    }

    // Fungsi untuk mendapatkan data langganan berdasarkan ID tertentu
    function getSubsID($id)
    {
        $query = "SELECT * FROM membershipsubscription WHERE subscription_id = '$id'";
        $this->execute($query); // Eksekusi query
        return $this->getResult(); // Mengembalikan hasil query
    }
    
    // Fungsi untuk menambahkan langganan baru ke dalam tabel 'membershipsubscription'
    function add($data)
    {
        // Mengambil data dari parameter
        $member_id = $data['id'];
        $subscription_type = $data['type'];
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $payment_method = $data['payment'];

        // Membuat query untuk menambahkan langganan baru
        $query = "INSERT INTO membershipsubscription (member_id, subscription_type, start_date, end_date, payment_method) VALUES ('$member_id', '$subscription_type', '$start_date', '$end_date', '$payment_method')";

        // Eksekusi query untuk menambahkan langganan baru
        $this->executeAffected($query);
    }

    // Fungsi untuk menghapus langganan dari tabel 'membershipsubscription' berdasarkan ID
    function delete($id)
    {
        $query = "DELETE FROM membershipsubscription WHERE subscription_id = '$id'";
        return $this->executeAffected($query); // Eksekusi query dan mengembalikan jumlah baris yang terpengaruh
    }

    // Fungsi untuk memperbarui data langganan di tabel 'membershipsubscription' berdasarkan ID
    function update($id, $data)
    {
        // Membuat query untuk memperbarui data langganan
        $query = "UPDATE membershipsubscription SET ";

        foreach ($data as $key => $value) {
            if ($key !== 'update') { // Mengabaikan kunci 'id' dan 'update'
                $query .= "$key = '$value', ";
            }
        }
        $query = rtrim($query, ", "); // Menghapus koma terakhir
        $query .= " WHERE subscription_id = '$id'";

        // Eksekusi query untuk memperbarui data langganan dan mengembalikan hasilnya
        return $this->executeAffected($query);
    }

    // Fungsi untuk mendapatkan member_id berdasarkan subscription_id dari tabel 'membershipsubscription'
    function getMemberId($subscription_id)
    {
        $query = "SELECT member_id FROM membershipsubscription WHERE subscription_id = '$subscription_id'";
        $this->execute($query); // Eksekusi query
        $result = $this->getResult(); // Mengambil hasil query
        return $result['member_id']; // Mengembalikan member_id jika ditemukan
    }

    // Fungsi untuk menghapus semua langganan terkait dengan ID member dari tabel 'membershipsubscription'
    function deleteByMemberId($member_id)
    {
        $query = "DELETE FROM membershipsubscription WHERE member_id = '$member_id'";
        return $this->executeAffected($query); // Eksekusi query dan mengembalikan jumlah baris yang terpengaruh
    }
}
