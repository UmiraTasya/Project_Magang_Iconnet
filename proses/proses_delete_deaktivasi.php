<?php
include "connect.php";
$id_deaktivasi = (isset($_POST['id_deaktivasi'])) ? htmlentities($_POST['id_deaktivasi']) : "";

if(!empty($_POST['delete_deaktivasi_validate'])){
    $query = mysqli_query($conn, "DELETE FROM tb_deaktivasi WHERE id_deaktivasi = '$id_deaktivasi'");
    if($query){
        $message = '<script>alert("Data Berhasil Dihapus");
                    window.location="../deaktivasi";
                    </script>';
    }else{
        $message = '<script>alert("Data Gagal Dihapus");
                    window.location="../deaktivasi";
                    </script>';
    }
}echo $message;
?>
