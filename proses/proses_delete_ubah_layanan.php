<?php
include "connect.php";
$id_ubah_layanan = (isset($_POST['id_ubah_layanan'])) ? htmlentities($_POST['id_ubah_layanan']) : "";

if(!empty($_POST['delete_ubah_layanan_validate'])){
    $query = mysqli_query($conn, "DELETE FROM tb_ubah_layanan WHERE id_ubah_layanan = '$id_ubah_layanan'");
    if($query){
        $message = '<script>alert("Data Berhasil Dihapus");
                    window.location="../ubahlayanan";
                    </script>';
    }else{
        $message = '<script>alert("Data Gagal Dihapus");
                    window.location="../ubahlayanan";
                    </script>';
    }
}echo $message;
?>
