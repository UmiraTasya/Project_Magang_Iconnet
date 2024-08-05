<?php
include "connect.php";

$id = isset($_POST['id']) ? htmlentities($_POST['id']) : "";
$name = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
$username = isset($_POST['username']) ? htmlentities($_POST['username']) : "";
$level = isset($_POST['level']) ? htmlentities($_POST['level']) : "";
$jabatan = isset($_POST['jabatan']) ? htmlentities($_POST['jabatan']) : "";
$nohp = isset($_POST['nohp']) ? htmlentities($_POST['nohp']) : "";
$alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : "";
$password = md5('password');

if (!empty($_POST['input_user_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND id != '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang dimasukkan telah ada"); window.location="../user";</script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_user SET nama='$name', username='$username', level='$level', jabatan='$jabatan', nohp='$nohp', alamat='$alamat' WHERE id='$id'");
        if ($query) {
            if (mysqli_affected_rows($conn) > 0) {
                $message = '<script>alert("Data Berhasil Diupdate"); window.location="../user";</script>';
            } else {
                $message = '<script>alert("Tidak ada data yang diperbarui"); window.location="../user";</script>';
            }
        } else {
            $message = '<script>alert("Data Gagal Diupdate"); window.location="../user";</script>';
        }
    }
} else {
    $message = '<script>alert("Form tidak valid"); window.location="../user";</script>';
}

echo $message;
?>
