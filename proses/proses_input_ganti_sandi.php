<?php

include "connect.php";

$tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
$nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
$id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
$no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
$nama_wifi = isset($_POST['nama_wifi']) ? htmlentities($_POST['nama_wifi']) : "";
$password_baru = isset($_POST['password_baru']) ? htmlentities($_POST['password_baru']) : "";
$status = isset($_POST['status']) ? htmlentities($_POST['status']) : "";
$tanggal_perbaikan = isset($_POST['tanggal_perbaikan']) && !empty($_POST['tanggal_perbaikan']) ? $_POST['tanggal_perbaikan'] : NULL;

// Array untuk memetakan ID status ke deskripsi teks
$statusList = [
    '1' => 'Belum Ditangani',
    '2' => 'Proses Penanganan',
    '3' => 'Selesai Perbaikan'
];

// Mendapatkan deskripsi teks dari ID status
$statusName = isset($statusList[$status]) ? $statusList[$status] : '';

if (!empty($_POST['input_ganti_sandi_validate'])) {
    $select = mysqli_query($conn, "SELECT id_pelanggan FROM tb_pergantian_sandi WHERE id_pelanggan = '$id_pelanggan'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Id Pelanggan yang dimasukkan telah ada");
        window.location="../pergantiansandi";
        </script>';
    } else {
        if ($status == '3') {
            // Jika status adalah "Selesai Perbaikan", masukkan data ke tb_laporan_pergantian_sandi
            $query_laporan = "INSERT INTO tb_laporan_pergantian_sandi (tanggal_melapor, nama, id_pelanggan, no_hp, nama_wifi, password_baru, status, tanggal_perbaikan) 
            VALUES ('$tanggal_melapor', '$nama', '$id_pelanggan', '$no_hp', '$nama_wifi', '$password_baru', '$statusName', " . ($tanggal_perbaikan ? "'$tanggal_perbaikan'" : "NULL") . ")";

            $result_laporan = mysqli_query($conn, $query_laporan);
            if ($result_laporan) {
                $message = '<script>alert("Data Berhasil Dimasukkan ke Laporan Pergantian Sandi");
                            window.location="../pergantiansandi";
                            </script>';
            } else {
                $message = '<script>alert("Data Gagal Dimasukkan ke Laporan Pergantian Sandi");
                            window.location="../pergantiansandi";
                            </script>';
            }
        } else {
            // Jika status bukan "Selesai Perbaikan", masukkan data ke tb_pergantian_sandi
            $query_gangguan = "INSERT INTO tb_pergantian_sandi (tanggal_melapor, nama, id_pelanggan, no_hp, nama_wifi, password_baru, status, tanggal_perbaikan) 
            VALUES ('$tanggal_melapor', '$nama', '$id_pelanggan', '$no_hp', '$nama_wifi', '$password_baru', '$statusName', " . ($tanggal_perbaikan ? "'$tanggal_perbaikan'" : "NULL") . ")";

            $result_gangguan = mysqli_query($conn, $query_gangguan);
            if ($result_gangguan) {
                $message = '<script>alert("Data Berhasil Dimasukkan ke Pergantian Sandi");
                            window.location="../pergantiansandi";
                            </script>';
            } else {
                $message = '<script>alert("Data Gagal Dimasukkan ke Pergantian Sandi");
                            window.location="../pergantiansandi";
                            </script>';
            }
        }
    }
}

echo $message;


// include "connect.php";

// $tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
// $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
// $id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
// $no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
// $nama_wifi = isset($_POST['nama_wifi']) ? htmlentities($_POST['nama_wifi']) : "";
// $password_baru = isset($_POST['password_baru']) ? htmlentities($_POST['password_baru']) : "";
// $status = isset($_POST['status']) ? htmlentities($_POST['status']) : "";
// $tanggal_perbaikan = isset($_POST['tanggal_perbaikan']) && !empty($_POST['tanggal_perbaikan']) ? $_POST['tanggal_perbaikan'] : NULL;

// // Array untuk memetakan ID status ke deskripsi teks
// $statusList = [
//     '1' => 'Belum Ditangani',
//     '2' => 'Proses Penanganan',
//     '3' => 'Selesai Perbaikan'
// ];

// // Mendapatkan deskripsi teks dari ID status
// $statusName = isset($statusList[$status]) ? $statusList[$status] : '';

// if (!empty($_POST['input_ganti_sandi_validate'])) {
//     $select = mysqli_query($conn, "SELECT id_pelanggan FROM tb_pergantian_sandi WHERE id_pelanggan = '$id_pelanggan'");
//     if (mysqli_num_rows($select) > 0) {
//         $message = '<script>alert("Id Pelanggan yang dimasukkan telah ada");
//         window.location="../pergantiansandi";
//         </script>';
//     } else {
//         // Menggunakan $statusName sebagai pengganti $status untuk menyimpan teks deskripsi status
//         $query = mysqli_query($conn, "INSERT INTO tb_pergantian_sandi (tanggal_melapor, nama, id_pelanggan, no_hp, nama_wifi, password_baru, status, tanggal_perbaikan) 
//         VALUES ('$tanggal_melapor', '$nama', '$id_pelanggan', '$no_hp', '$nama_wifi', '$password_baru', '$statusName', " . ($tanggal_perbaikan ? "'$tanggal_perbaikan'" : "NULL") . ")");
        
//         if ($query) {
//             $message = '<script>alert("Data Berhasil Dimasukkan");
//                         window.location="../pergantiansandi";
//                         </script>';
//         } else {
//             $message = '<script>alert("Data Gagal Dimasukkan");
//                         window.location="../pergantiansandi";
//                         </script>';
//         }
//     }
// }
// echo $message;
?>
