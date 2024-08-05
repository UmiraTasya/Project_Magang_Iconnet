<?php
include "connect.php";
$id_gangguan = (isset($_POST['id_gangguan'])) ? htmlentities($_POST['id_gangguan']) : "";
$foto = (isset($_POST['foto'])) ? htmlentities($_POST['foto']) : "";

if(!empty($_POST['input_user_validate'])){
    $query = mysqli_query($conn, "DELETE FROM tb_gangguan WHERE id_gangguan = '$id_gangguan'");
    if($query){
        unlink("../assets/img/$foto");
        $message = '<script>alert("Data Berhasil Dihapus");
                    window.location="../gangguan";
                    </script>';
    }else{
        $message = '<script>alert("Data Gagal Dihapus");
                    window.location="../gangguan";
                    </script>';
    }
}echo $message;
?>
