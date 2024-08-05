<?php

include "connect.php";

$tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
$nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
$id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
$no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
$layanan_lama = isset($_POST['layanan_lama']) ? htmlentities($_POST['layanan_lama']) : "";
$layanan_baru = isset($_POST['layanan_baru']) ? htmlentities($_POST['layanan_baru']) : "";
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

if (!empty($_POST['input_ubah_layanan_validate'])) {
    $select = mysqli_query($conn, "SELECT id_pelanggan FROM tb_ubah_layanan WHERE id_pelanggan = '$id_pelanggan'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Id Pelanggan yang dimasukkan telah ada");
        window.location="../ubahlayanan";
        </script>';
    } else {
        if ($status == '3') {
            // Jika status adalah "Selesai Perbaikan", masukkan data ke tb_laporan_Ubah_Layanan
            $query_laporan = "INSERT INTO tb_laporan_ubah_layanan (tanggal_melapor, nama, id_pelanggan, no_hp, layanan_lama, layanan_baru, status, tanggal_perbaikan) 
            VALUES ('$tanggal_melapor', '$nama', '$id_pelanggan', '$no_hp', '$layanan_lama', '$layanan_baru', '$statusName', " . ($tanggal_perbaikan ? "'$tanggal_perbaikan'" : "NULL") . ")";

            $result_laporan = mysqli_query($conn, $query_laporan);
            if ($result_laporan) {
                $message = '<script>alert("Data Berhasil Dimasukkan ke Laporan Ubah Layanan");
                            window.location="../ubahlayanan";
                            </script>';
            } else {
                $message = '<script>alert("Data Gagal Dimasukkan ke Laporan Ubah Layanan");
                            window.location="../ubahlayanan";
                            </script>';
            }
        } else {
            // Jika status bukan "Selesai Perbaikan", masukkan data ke tb_Ubah Layanan
            $query_ubahlayanan = "INSERT INTO tb_Ubah_layanan (tanggal_melapor, nama, id_pelanggan, no_hp, layanan_lama, layanan_baru, status, tanggal_perbaikan) 
            VALUES ('$tanggal_melapor', '$nama', '$id_pelanggan', '$no_hp', '$layanan_lama', '$layanan_baru', '$statusName', " . ($tanggal_perbaikan ? "'$tanggal_perbaikan'" : "NULL") . ")";

            $result_ubahlayanan = mysqli_query($conn, $query_ubahlayanan);
            if ($result_ubahlayanan) {
                $message = '<script>alert("Data Berhasil Dimasukkan ke Ubah Layanan");
                            window.location="../ubahlayanan";
                            </script>';
            } else {
                $message = '<script>alert("Data Gagal Dimasukkan ke Ubah Layanan");
                            window.location="../ubahlayanan";
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
// $layanan_lama = isset($_POST['layanan_lama']) ? htmlentities($_POST['layanan_lama']) : "";
// $layanan_baru = isset($_POST['layanan_baru']) ? htmlentities($_POST['layanan_baru']) : "";
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

// if (!empty($_POST['input_ubah_layanan_validate'])) {
//     $select = mysqli_query($conn, "SELECT id_pelanggan FROM tb_ubah_layanan WHERE id_pelanggan = '$id_pelanggan'");
//     if (mysqli_num_rows($select) > 0) {
//         $message = '<script>alert("Id Pelanggan yang dimasukkan telah ada");
//         window.location="../ubahlayanan";
//         </script>';
//     } else {
//         // Menggunakan $statusName sebagai pengganti $status untuk menyimpan teks deskripsi status
//         $query = mysqli_query($conn, "INSERT INTO tb_ubah_layanan (tanggal_melapor, nama, id_pelanggan, no_hp, layanan_lama, layanan_baru, status, tanggal_perbaikan) 
//         VALUES ('$tanggal_melapor', '$nama', '$id_pelanggan', '$no_hp', '$layanan_lama', '$layanan_baru', '$statusName', " . ($tanggal_perbaikan ? "'$tanggal_perbaikan'" : "NULL") . ")");
        
//         if ($query) {
//             $message = '<script>alert("Data Berhasil Dimasukkan");
//                         window.location="../ubahlayanan";
//                         </script>';
//         } else {
//             $message = '<script>alert("Data Gagal Dimasukkan");
//                         window.location="../ubahlayanan";
//                         </script>';
//         }
//     }
// }
// echo $message;
?>
