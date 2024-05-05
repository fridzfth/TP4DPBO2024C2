<?php

class Template
{
    var $filename = ''; // Variabel untuk menyimpan nama file template
    var $content = ''; // Variabel untuk menyimpan konten dari template

    function __construct($filename='')
    {
        $this->filename = $filename;

        // Mengambil konten dari file template dan menyimpannya ke dalam variabel $content
        $this->content = implode('', @file($filename));
    }

    function clear()
    {
        // Menghapus semua placeholder yang diawali dengan "DATA_" dari konten template menggunakan regular expression
        $this->content = preg_replace("/DATA_[A-Z|_|0-9]+/", "", $this->content);
    }

    function write()
    {
        $this->clear();
        // Menampilkan konten template yang telah dimodifikasi
        print $this->content;
    }

    function getContent()
    {
        $this->clear();
        // Mengembalikan konten template yang telah dimodifikasi
        return $this->content;
    }

    function replace($old = '', $new = '')
    {
        // Mengganti placeholder lama dengan nilai baru dalam konten template
        if (is_int($new)) {
            $value = sprintf("%d", $new); // Mengonversi nilai integer ke string dengan format yang tepat
        }
        elseif (is_float($new)) {
            $value = sprintf("%f", $new); // Mengonversi nilai float ke string dengan format yang tepat
        }
        elseif (is_array($new)) {
            $value = '';

            foreach ($new as $item) {
                $value .= $item. ' '; // Menggabungkan nilai-nilai dalam array menjadi satu string
            }
        }
        else {
            $value = $new; // Menyimpan nilai baru langsung jika bukan integer, float, atau array
        }
        // Mengganti placeholder lama dengan nilai baru dalam konten template menggunakan regular expression
        $this->content = preg_replace("/$old/", $value, $this->content);
    }
}

?>
