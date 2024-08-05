<?php

// Sertakan file koneksi database
include "connect.php";

// Pastikan id_deaktivasi terdefinisi dan bukan kosong
if (isset($_POST['id_deaktivasi']) && !empty($_POST['id_deaktivasi'])) {
    $id_deaktivasi = $_POST['id_deaktivasi'];

    // Ambil data dari formulir
    $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
    $tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
    $id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
    $no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
    $alasan_deaktivasi = isset($_POST['alasan_deaktivasi']) ? htmlentities($_POST['alasan_deaktivasi']) : "";
    $status = isset($_POST['status']) ? $_POST['status'] : "";
    $tanggal_perbaikan = isset($_POST['tanggal_perbaikan']) ? $_POST['tanggal_perbaikan'] : NULL;

    // Escape string untuk mencegah SQL Injection
    $nama = mysqli_real_escape_string($conn, $nama);
    $tanggal_melapor = mysqli_real_escape_string($conn, $tanggal_melapor);
    $id_pelanggan = mysqli_real_escape_string($conn, $id_pelanggan);
    $no_hp = mysqli_real_escape_string($conn, $no_hp);
    $alasan_deaktivasi = mysqli_real_escape_string($conn, $alasan_deaktivasi);
    $status = mysqli_real_escape_string($conn, $status);
    $tanggal_perbaikan = $tanggal_perbaikan ? "'" . mysqli_real_escape_string($conn, $tanggal_perbaikan) . "'" : "NULL";

    // Periksa apakah ID pelanggan sudah ada di database untuk data lainnya
    $selectQuery = "SELECT * FROM tb_deaktivasi WHERE id_pelanggan = '$id_pelanggan' AND id_deaktivasi != '$id_deaktivasi'";
    $select = mysqli_query($conn, $selectQuery);

    if (!$select) {
        die("Query Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("ID Pelanggan yang dimasukkan telah ada"); window.location="../deaktivasi";</script>';
    } else {
        // Update query
        $query = "UPDATE tb_deaktivasi SET 
            nama = '$nama',
            tanggal_melapor = '$tanggal_melapor',
            id_pelanggan = '$id_pelanggan',
            no_hp = '$no_hp',
            alasan_deaktivasi = '$alasan_deaktivasi',
            status = '$status',
            tanggal_perbaikan = $tanggal_perbaikan
            WHERE id_deaktivasi = '$id_deaktivasi'";

        $result = mysqli_query($conn, $query);
        if ($result) {
            // Cek apakah ada data yang diperbarui
            if (mysqli_affected_rows($conn) > 0) {
                if ($status == "Selesai Perbaikan") {
                    // Ambil data dari tb_deaktivasi untuk dimasukkan ke tb_laporan_deaktivasi
                    $selectDeaktivasiQuery = "SELECT * FROM tb_deaktivasi WHERE id_deaktivasi = '$id_deaktivasi'";
                    $selectDeaktivasi = mysqli_query($conn, $selectDeaktivasiQuery);
                    if ($selectDeaktivasi && mysqli_num_rows($selectDeaktivasi) > 0) {
                        $DeaktivasiData = mysqli_fetch_assoc($selectDeaktivasi);

                        // Insert data ke tb_laporan_deaktivasi
                        $insertQuery = "INSERT INTO tb_laporan_deaktivasi (nama, tanggal_melapor, id_pelanggan, no_hp, alasan_deaktivasi, status, tanggal_perbaikan)
                                        VALUES ('$nama', '$tanggal_melapor', '$id_pelanggan', '$no_hp', '$alasan_deaktivasi', '$status', $tanggal_perbaikan)";
                        $insertResult = mysqli_query($conn, $insertQuery);
                        if ($insertResult) {
                            // Hapus data dari tb_deaktivasi setelah berhasil dipindahkan
                            $deleteQuery = "DELETE FROM tb_deaktivasi WHERE id_deaktivasi = '$id_deaktivasi'";
                            $deleteResult = mysqli_query($conn, $deleteQuery);
                            if ($deleteResult) {
                                $message = '<script>alert("Data Berhasil Dipindahkan ke Laporan Deaktivasi dan dihapus dari Deaktivasi"); window.location="../deaktivasi";</script>';
                            } else {
                                $message = '<script>alert("Gagal menghapus data dari Deaktivasi"); window.location="../deaktivasi";</script>';
                            }
                        } else {
                            $message = '<script>alert("Gagal memindahkan data ke laporan Deaktivasi"); window.location="../deaktivasi";</script>';
                        }
                    } else {
                        $message = '<script>alert("Data Deaktivasi tidak ditemukan"); window.location="../deaktivasi";</script>';
                    }
                } else {
                    $message = '<script>alert("Data Berhasil Diperbarui"); window.location="../deaktivasi";</script>';
                }
            } else {
                // Tidak ada data yang diperbarui
                $message = '<script>alert("Tidak ada data yang diperbarui"); window.location="../deaktivasi";</script>';
            }
        } else {
            $message = '<script>alert("Data gagal diperbarui"); window.location="../deaktivasi";</script>';
        }
    }
} else {
    $message = '<script>alert("ID Ubah Layanan tidak valid"); window.location="../deaktivasi";</script>';
}

echo $message;

// // Pastikan file ini hanya dapat diakses setelah user submit form
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Panggil file koneksi database
//     include "connect.php";

//     // Ambil data dari form
//     $id_deaktivasi = isset($_POST['id_deaktivasi']) ? htmlentities($_POST['id_deaktivasi']) : "";
//     $tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
//     $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
//     $id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
//     $no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
//     $alasan_deaktivasi = isset($_POST['alasan_deaktivasi']) ? htmlentities($_POST['alasan_deaktivasi']) : "";
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
//     $selectId = mysqli_query($conn, "SELECT id_deaktivasi FROM tb_deaktivasi WHERE id_deaktivasi = '$id_deaktivasi'");
//     if (mysqli_num_rows($selectId) == 0) {
//         $message = '<script>alert("Id Deaktivasi tidak valid");
//                     window.location="../deaktivasi";
//                     </script>';
//     } else {
//         // Memeriksa apakah id_pelanggan sudah ada dengan id ubah layanan yang berbeda
//         $select = mysqli_query($conn, "SELECT id_pelanggan FROM tb_deaktivasi WHERE id_pelanggan = '$id_pelanggan' AND id_deaktivasi != '$id_deaktivasi'");
//         if (mysqli_num_rows($select) > 0) {
//             $message = '<script>alert("Id Pelanggan yang dimasukkan telah ada");
//             window.location="../deaktivasi";
//             </script>';
//         } else {
//             // Menggunakan $status sebagai pengganti $statusName untuk menyimpan ID status
//             $query = mysqli_query($conn, "UPDATE tb_deaktivasi SET tanggal_melapor='$tanggal_melapor', nama='$nama', id_pelanggan='$id_pelanggan', 
//                                         no_hp='$no_hp', alasan_deaktivasi='$alasan_deaktivasi', status='$status', tanggal_perbaikan=" . ($tanggal_perbaikan ? "'$tanggal_perbaikan'" : "NULL") . " WHERE id_deaktivasi='$id_deaktivasi'");
//             if ($query) {
//                 $message = '<script>alert("Data Berhasil DiUpdate");
//                             window.location="../deaktivasi";
//                             </script>';
//             } else {
//                 $message = '<script>alert("Data Gagal DiUpdate");
//                             window.location="../deaktivasi";
//                             </script>';
//             }
//         }
//     }

//     echo isset($message) ? $message : '';
// } else {
//     // Jika user mencoba mengakses file ini langsung, redirect ke halaman lain
//     header("Location: ../deaktivasi");
//     exit();
// }
?>
