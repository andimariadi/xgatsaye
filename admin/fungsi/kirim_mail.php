<?php
$nama = "Andi Mariadi";
$to = "mariadi.andi@gmail.com";
$subject = "Sebuah Subject untuk belajar email";
$messages = "Hallo saya Admin, saya ingin menginformasikan bahwa ada informasi yg harus ditinjau kembali.";

$kirim=@mail($to,"Test kirim pesan email","Email ini dikirim dari localhost") ;
   
if($kirim) 
{
    echo "pengiriman berhasil";
}
else 
{
    echo "pengiriman gagal";
}
?>