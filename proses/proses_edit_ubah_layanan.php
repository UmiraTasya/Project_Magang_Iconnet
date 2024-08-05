<?php

// Sertakan file koneksi database
include "connect.php";

// Pastikan id_ganti_sandi terdefinisi dan bukan kosong
if (isset($_POST['id_ubah_layanan']) && !empty($_POST['id_ubah_layanan'])) {
    $id_ubah_layanan = $_POST['id_ubah_layanan'];

    // Ambil data dari formulir
    $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
    $tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
    $id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
    $no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
    $layanan_lama = isset($_POST['layanan_lama']) ? htmlentities($_POST['layanan_lama']) : "";
    $layanan_baru = isset($_POST['layanan_baru']) ? htmlentities($_POST['layanan_baru']) : "";
    $status = isset($_POST['status']) ? $_POST['status'] : "";
    $tanggal_perbaikan = isset($_POST['tanggal_perbaikan']) ? $_POST['tanggal_perbaikan'] : NULL;

    // Escape string untuk mencegah SQL Injection
    $nama = mysqli_real_escape_string($conn, $nama);
    $tanggal_melapor = mysqli_real_escape_string($conn, $tanggal_melapor);
    $id_pelanggan = mysqli_real_escape_string($conn, $id_pelanggan);
    $no_hp = mysqli_real_escape_string($conn, $no_hp);
    $layanan_lama = mysqli_real_escape_string($conn, $layanan_lama);
    $layanan_baru = mysqli_real_escape_string($conn, $layanan_baru);
    $status = mysqli_real_escape_string($conn, $status);
    $tanggal_perbaikan = $tanggal_perbaikan ? "'" . mysqli_real_escape_string($conn, $tanggal_perbaikan) . "'" : "NULL";

    // Periksa apakah ID pelanggan sudah ada di database untuk data lainnya
    $selectQuery = "SELECT * FROM tb_ubah_layanan WHERE id_pelanggan = '$id_pelanggan' AND id_ubah_layanan != '$id_ubah_layanan'";
    $select = mysqli_query($conn, $selectQuery);

    if (!$select) {
        die("Query Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("ID Pelanggan yang dimasukkan telah ada"); window.location="../ubahlayanan";</script>';
    } else {
        // Update query
        $query = "UPDATE tb_ubah_layanan SET 
            nama = '$nama',
            tanggal_melapor = '$tanggal_melapor',
            id_pelanggan = '$id_pelanggan',
            no_hp = '$no_hp',
            layanan_lama = '$layanan_lama',
            layanan_baru = '$layanan_baru',
            status = '$status',
            tanggal_perbaikan = $tanggal_perbaikan
            WHERE id_ubah_layanan = '$id_ubah_layanan'";

        $result = mysqli_query($conn, $query);
        if ($result) {
            // Cek apakah ada data yang diperbarui
            if (mysqli_affected_rows($conn) > 0) {
                if ($status == "Selesai Perbaikan") {
                    // Ambil data dari tb_pergantian_sandi untuk dimasukkan ke tb_laporan_ubah_layanan
                    $selectPergantianUbahLayananQuery = "SELECT * FROM tb_ubah_layanan WHERE id_ubah_layanan = '$id_ubah_layanan'";
                    $selectUbahLayanan = mysqli_query($conn, $selectPergantianUbahLayananQuery);
                    if ($selectUbahLayanan && mysqli_num_rows($selectUbahLayanan) > 0) {
                        $UbahLayananData = mysqli_fetch_assoc($selectUbahLayanan);

                        // Insert data ke tb_laporan_ubah_layanan
                        $insertQuery = "INSERT INTO tb_laporan_ubah_layanan (nama, tanggal_melapor, id_pelanggan, no_hp, layanan_lama, layanan_baru, status, tanggal_perbaikan)
                                        VALUES ('$nama', '$tanggal_melapor', '$id_pelanggan', '$no_hp', '$layanan_lama', '$layanan_baru', '$status', $tanggal_perbaikan)";
                        $insertResult = mysqli_query($conn, $insertQuery);
                        if ($insertResult) {
                            // Hapus data dari tb_ubah_layanan setelah berhasil dipindahkan
                            $deleteQuery = "DELETE FROM tb_ubah_layanan WHERE id_ubah_layanan = '$id_ubah_layanan'";
                            $deleteResult = mysqli_query($conn, $deleteQuery);
                            if ($deleteResult) {
                                $message = '<script>alert("Data Berhasil Dipindahkan ke Laporan Ubah Layanan dan dihapus dari Ubah Layanan"); window.location="../ubahlayanan";</script>';
                            } else {
                                $message = '<script>alert("Gagal menghapus data dari Ubah Layanan"); window.location="../ubahlayanan";</script>';
                            }
                        } else {
                            $message = '<script>alert("Gagal memindahkan data ke laporan Ubah Layanan"); window.location="../ubahlayanan";</script>';
                        }
                    } else {
                        $message = '<script>alert("Data Ubah Layanan tidak ditemukan"); window.location="../ubahlayanan";</script>';
                    }
                } else {
                    $message = '<script>alert("Data Berhasil Diperbarui"); window.location="../ubahlayanan";</script>';
                }
            } else {
                // Tidak ada data yang diperbarui
                $message = '<script>alert("Tidak ada data yang diperbarui"); window.location="../ubahlayanan";</script>';
            }
        } else {
            $message = '<script>alert("Data gagal diperbarui"); window.location="../ubahlayanan";</script>';
        }
    }
} else {
    $message = '<script>alert("ID Ubah Layanan tidak valid"); window.location="../ubahlayanan";</script>';
}

echo $message;


// // Pastikan file ini hanya dapat diakses setelah user submit form
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Panggil file koneksi database
//     include "connect.php";

//     // Ambil data dari form
//     $id_ubah_layanan = isset($_POST['id_ubah_layanan']) ? htmlentities($_POST['id_ubah_layanan']) : "";
//     $tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
//     $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
//     $id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
//     $no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
//     $layanan_lama = isset($_POST['layanan_lama']) ? htmlentities($_POST['layanan_lama']) : "";
//     $layanan_baru = isset($_POST['layanan_baru']) ? htmlentities($_POST['layanan_baru']) : "";
//     $status = isset($_POST['status']) ? $_POST['status'] : "";
//     $tanggal_perbaikan = isset($_POST['tanggal_perbaikan']) && !empty($_POST['tanggal_perbaikan']) ? $_POST['tanggal_perbaikan'] : NULL;

//     // Array untuk memetakan ID status ke deskripsi teks
//     $statusList = [
//         'Belum Ditangani',
//         'Proses Penanganan',
//         'Selesai Perbaikan'
//     ];

//     // Mendapatkan deskripsi teks dari ID status
//     $statusName = isset($statusList[$status]) ? $statusList[$status] : '';

//     // Validasi apakah id ubah layanan ada di database
//     $selectId = mysqli_query($conn, "SELECT id_ubah_layanan FROM tb_ubah_layanan WHERE id_ubah_layanan = '$id_ubah_layanan'");
//     if (mysqli_num_rows($selectId) == 0) {
//         $message = '<script>alert("Id Ubah Layanan tidak valid");
//                     window.location="../ubahlayanan";
//                     </script>';
//     } else {
//         // Memeriksa apakah id_pelanggan sudah ada dengan id ubah layanan yang berbeda
//         $select = mysqli_query($conn, "SELECT id_pelanggan FROM tb_ubah_layanan WHERE id_pelanggan = '$id_pelanggan' AND id_ubah_layanan != '$id_ubah_layanan'");
//         if (mysqli_num_rows($select) > 0) {
//             $message = '<script>alert("Id Pelanggan yang dimasukkan telah ada");
//             window.location="../ubahlayanan";
//             </script>';
//         } else {
//             // Menggunakan $status sebagai pengganti $statusName untuk menyimpan ID status
//             $query = mysqli_query($conn, "UPDATE tb_ubah_layanan SET tanggal_melapor='$tanggal_melapor', nama='$nama', id_pelanggan='$id_pelanggan', 
//                                         no_hp='$no_hp', layanan_lama='$layanan_lama', layanan_baru='$layanan_baru', status='$status', tanggal_perbaikan=" . ($tanggal_perbaikan ? "'$tanggal_perbaikan'" : "NULL") . " WHERE id_ubah_layanan='$id_ubah_layanan'");
//             if ($query) {
//                 $message = '<script>alert("Data Berhasil DiUpdate");
//                             window.location="../ubahlayanan";
//                             </script>';
//             } else {
//                 $message = '<script>alert("Data Gagal DiUpdate");
//                             window.location="../ubahlayanan";
//                             </script>';
//             }
//         }
//     }

//     echo isset($message) ? $message : '';
// } else {
//     // Jika user mencoba mengakses file ini langsung, redirect ke halaman lain
//     header("Location: ../ubahlayanan");
//     exit();
// }
?>
