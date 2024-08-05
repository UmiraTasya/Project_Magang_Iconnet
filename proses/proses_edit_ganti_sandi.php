<?php
// Sertakan file koneksi database
include "connect.php";

// Pastikan id_ganti_sandi terdefinisi dan bukan kosong
if (isset($_POST['id_ganti_sandi']) && !empty($_POST['id_ganti_sandi'])) {
    $id_ganti_sandi = $_POST['id_ganti_sandi'];

    // Ambil data dari formulir
    $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
    $tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
    $id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
    $no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
    $nama_wifi = isset($_POST['nama_wifi']) ? htmlentities($_POST['nama_wifi']) : "";
    $password_baru = isset($_POST['password_baru']) ? htmlentities($_POST['password_baru']) : "";
    $status = isset($_POST['status']) ? $_POST['status'] : "";
    $tanggal_perbaikan = isset($_POST['tanggal_perbaikan']) ? $_POST['tanggal_perbaikan'] : NULL;

    // Escape string untuk mencegah SQL Injection
    $nama = mysqli_real_escape_string($conn, $nama);
    $tanggal_melapor = mysqli_real_escape_string($conn, $tanggal_melapor);
    $id_pelanggan = mysqli_real_escape_string($conn, $id_pelanggan);
    $no_hp = mysqli_real_escape_string($conn, $no_hp);
    $nama_wifi = mysqli_real_escape_string($conn, $nama_wifi);
    $password_baru = mysqli_real_escape_string($conn, $password_baru);
    $status = mysqli_real_escape_string($conn, $status);
    $tanggal_perbaikan = $tanggal_perbaikan ? "'" . mysqli_real_escape_string($conn, $tanggal_perbaikan) . "'" : "NULL";

    // Periksa apakah ID pelanggan sudah ada di database untuk data lainnya
    $selectQuery = "SELECT * FROM tb_pergantian_sandi WHERE id_pelanggan = '$id_pelanggan' AND id_ganti_sandi != '$id_ganti_sandi'";
    $select = mysqli_query($conn, $selectQuery);

    if (!$select) {
        die("Query Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("ID Pelanggan yang dimasukkan telah ada"); window.location="../pergantiansandi";</script>';
    } else {
        // Update query
        $query = "UPDATE tb_pergantian_sandi SET 
            nama = '$nama',
            tanggal_melapor = '$tanggal_melapor',
            id_pelanggan = '$id_pelanggan',
            no_hp = '$no_hp',
            nama_wifi = '$nama_wifi',
            password_baru = '$password_baru',
            status = '$status',
            tanggal_perbaikan = $tanggal_perbaikan
            WHERE id_ganti_sandi = '$id_ganti_sandi'";

        $result = mysqli_query($conn, $query);
        if ($result) {
            // Cek apakah ada data yang diperbarui
            if (mysqli_affected_rows($conn) > 0) {
                if ($status == "Selesai Perbaikan") {
                    // Ambil data dari tb_pergantian_sandi untuk dimasukkan ke tb_laporan_pergantian_sandi
                    $selectPergantianSandiQuery = "SELECT * FROM tb_pergantian_sandi WHERE id_ganti_sandi = '$id_ganti_sandi'";
                    $selectPergantianSandi = mysqli_query($conn, $selectPergantianSandiQuery);
                    if ($selectPergantianSandi && mysqli_num_rows($selectPergantianSandi) > 0) {
                        $pergantianSandiData = mysqli_fetch_assoc($selectPergantianSandi);

                        // Insert data ke tb_laporan_pergantian_sandi
                        $insertQuery = "INSERT INTO tb_laporan_pergantian_sandi (nama, tanggal_melapor, id_pelanggan, no_hp, nama_wifi, password_baru, status, tanggal_perbaikan)
                                        VALUES ('$nama', '$tanggal_melapor', '$id_pelanggan', '$no_hp', '$nama_wifi', '$password_baru', '$status', $tanggal_perbaikan)";
                        $insertResult = mysqli_query($conn, $insertQuery);
                        if ($insertResult) {
                            // Hapus data dari tb_pergantian_sandi setelah berhasil dipindahkan
                            $deleteQuery = "DELETE FROM tb_pergantian_sandi WHERE id_ganti_sandi = '$id_ganti_sandi'";
                            $deleteResult = mysqli_query($conn, $deleteQuery);
                            if ($deleteResult) {
                                $message = '<script>alert("Data Berhasil Dipindahkan ke Laporan Pergantian Sandi dan dihapus dari Pergantian Sandi"); window.location="../pergantiansandi";</script>';
                            } else {
                                $message = '<script>alert("Gagal menghapus data dari Pergantian Sandi"); window.location="../pergantiansandi";</script>';
                            }
                        } else {
                            $message = '<script>alert("Gagal memindahkan data ke laporan pergantian sandi"); window.location="../pergantiansandi";</script>';
                        }
                    } else {
                        $message = '<script>alert("Data pergantian sandi tidak ditemukan"); window.location="../pergantiansandi";</script>';
                    }
                } else {
                    $message = '<script>alert("Data Berhasil Diperbarui"); window.location="../pergantiansandi";</script>';
                }
            } else {
                // Tidak ada data yang diperbarui
                $message = '<script>alert("Tidak ada data yang diperbarui"); window.location="../pergantiansandi";</script>';
            }
        } else {
            $message = '<script>alert("Data gagal diperbarui"); window.location="../pergantiansandi";</script>';
        }
    }
} else {
    $message = '<script>alert("ID Pergantian Sandi tidak valid"); window.location="../pergantiansandi";</script>';
}

echo $message;







// // Pastikan file ini hanya dapat diakses setelah user submit form
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Panggil file koneksi database
//     include "connect.php";

//     // Ambil data dari form
//     $id_ganti_sandi = isset($_POST['id_ganti_sandi']) ? htmlentities($_POST['id_ganti_sandi']) : "";
//     $tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
//     $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
//     $id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
//     $no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
//     $nama_wifi = isset($_POST['nama_wifi']) ? htmlentities($_POST['nama_wifi']) : "";
//     $password_baru = isset($_POST['password_baru']) ? htmlentities($_POST['password_baru']) : "";
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

//     // Validasi apakah id_ganti_sandi ada di database
//     $selectId = mysqli_query($conn, "SELECT id_ganti_sandi FROM tb_pergantian_sandi WHERE id_ganti_sandi = '$id_ganti_sandi'");
//     if (mysqli_num_rows($selectId) == 0) {
//         $message = '<script>alert("Id ganti sandi tidak valid");
//                     window.location="../pergantiansandi";
//                     </script>';
//     } else {
//         // Memeriksa apakah id_pelanggan sudah ada dengan id_ganti_sandi yang berbeda
//         $select = mysqli_query($conn, "SELECT id_pelanggan FROM tb_pergantian_sandi WHERE id_pelanggan = '$id_pelanggan' AND id_ganti_sandi != '$id_ganti_sandi'");
//         if (mysqli_num_rows($select) > 0) {
//             $message = '<script>alert("Id Pelanggan yang dimasukkan telah ada");
//             window.location="../pergantiansandi";
//             </script>';
//         } else {
//             // Menggunakan $status sebagai pengganti $statusName untuk menyimpan ID status
//             $query = mysqli_query($conn, "UPDATE tb_pergantian_sandi SET tanggal_melapor='$tanggal_melapor', nama='$nama', id_pelanggan='$id_pelanggan', 
//                                         no_hp='$no_hp', nama_wifi='$nama_wifi', password_baru='$password_baru', status='$status', tanggal_perbaikan=" . ($tanggal_perbaikan ? "'$tanggal_perbaikan'" : "NULL") . " WHERE id_ganti_sandi='$id_ganti_sandi'");
//             if ($query) {
//                 $message = '<script>alert("Data Berhasil DiUpdate");
//                             window.location="../pergantiansandi";
//                             </script>';
//             } else {
//                 $message = '<script>alert("Data Gagal DiUpdate");
//                             window.location="../pergantiansandi";
//                             </script>';
//             }
//         }
//     }

//     echo isset($message) ? $message : '';
// } else {
//     // Jika user mencoba mengakses file ini langsung, redirect ke halaman lain
//     header("Location: ../pergantiansandi");
//     exit();
// }
?>
