<?php
include "connect.php";
$id_ganti_sandi = (isset($_POST['id_ganti_sandi'])) ? htmlentities($_POST['id_ganti_sandi']) : "";

if(!empty($_POST['delete_ganti_sandi_validate'])){
    $query = mysqli_query($conn, "DELETE FROM tb_pergantian_sandi WHERE id_ganti_sandi = '$id_ganti_sandi'");
    if($query){
        $message = '<script>alert("Data Berhasil Dihapus");
                    window.location="../pergantiansandi";
                    </script>';
    }else{
        $message = '<script>alert("Data Gagal Dihapus");
                    window.location="../pergantiansandi";
                    </script>';
    }
}echo $message;
?>
