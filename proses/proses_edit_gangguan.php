<?php
// Sertakan file koneksi database
include "connect.php";

// Pastikan id_gangguan terdefinisi dan bukan kosong
if (isset($_POST['id_gangguan']) && !empty($_POST['id_gangguan'])) {
    $id_gangguan = $_POST['id_gangguan'];

    // Ambil data dari formulir
    $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
    $tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
    $id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
    $no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
    $status = isset($_POST['status']) ? $_POST['status'] : "";
    $tanggal_perbaikan = isset($_POST['tanggal_perbaikan']) ? $_POST['tanggal_perbaikan'] : NULL;

    // Validasi foto
    $target_dir = "../assets/img/";
    $kode_rand = rand(10000, 99999) . "-";
    $target_file = $target_dir . $kode_rand . basename($_FILES['foto']['name']);
    $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $statusUpload = 1;

    // Validasi file gambar
    if (!empty($_FILES['foto']['tmp_name'])) {
        $cek = getimagesize($_FILES['foto']['tmp_name']);
        if ($cek === false) {
            $message = "Ini bukan file gambar";
            $statusUpload = 0;
        } elseif (file_exists($target_file)) {
            $message = "Maaf, file yang dimasukkan telah ada";
            $statusUpload = 0;
        } elseif ($_FILES['foto']['size'] > 5000000) { // 5 MB
            $message = "File foto yang diupload terlalu besar";
            $statusUpload = 0;
        } elseif (!in_array($imageType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $message = "Maaf, hanya diperbolehkan gambar yang memiliki format JPG, JPEG, PNG, dan GIF";
            $statusUpload = 0;
        }
    } else {
        $message = "Tidak ada file yang diupload";
        $statusUpload = 0;
    }

    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ', Gambar tidak dapat diupload "); window.location="../gangguan";</script>';
    } else {
        // Periksa apakah ID pelanggan sudah ada di database untuk data lainnya
        $selectQuery = "SELECT * FROM tb_gangguan WHERE id_gangguan != '$id_gangguan' AND id_pelanggan = '$id_pelanggan'";
        $select = mysqli_query($conn, $selectQuery);

        if (!$select) {
            die("Query Error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("ID Pelanggan yang dimasukkan telah ada"); window.location="../gangguan";</script>';
        } else {
            // Escape string untuk mencegah SQL Injection
            $nama = mysqli_real_escape_string($conn, $nama);
            $tanggal_melapor = mysqli_real_escape_string($conn, $tanggal_melapor);
            $id_pelanggan = mysqli_real_escape_string($conn, $id_pelanggan);
            $no_hp = mysqli_real_escape_string($conn, $no_hp);
            $status = mysqli_real_escape_string($conn, $status);
            $tanggal_perbaikan = $tanggal_perbaikan ? "'" . mysqli_real_escape_string($conn, $tanggal_perbaikan) . "'" : "NULL";

            // Update query
            $query = "UPDATE tb_gangguan SET 
                foto = '$kode_rand" . $_FILES['foto']['name'] . "',
                nama = '$nama',
                tanggal_melapor = '$tanggal_melapor',
                id_pelanggan = '$id_pelanggan',
                no_hp = '$no_hp',
                status = '$status',
                tanggal_perbaikan = $tanggal_perbaikan
                WHERE id_gangguan = '$id_gangguan'";

            // Pindahkan file gambar ke direktori tujuan
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $result = mysqli_query($conn, $query);
                if ($result) {
                    // Cek apakah status perbaikan adalah "Selesai Perbaikan"
                    if ($status == "Selesai Perbaikan") {
                        // Ambil data dari tb_gangguan untuk dimasukkan ke tb_laporan_gangguan
                        $selectGangguanQuery = "SELECT * FROM tb_gangguan WHERE id_gangguan = '$id_gangguan'";
                        $selectGangguan = mysqli_query($conn, $selectGangguanQuery);
                        if ($selectGangguan && mysqli_num_rows($selectGangguan) > 0) {
                            $gangguanData = mysqli_fetch_assoc($selectGangguan);

                            // Insert data ke tb_laporan_gangguan
                            $insertQuery = "INSERT INTO tb_laporan_gangguan (foto, nama, tanggal_melapor, id_pelanggan, no_hp, status, tanggal_perbaikan)
                                            VALUES ('$gangguanData[foto]', '$nama', '$tanggal_melapor', '$id_pelanggan', '$no_hp', '$status', $tanggal_perbaikan)";
                            $insertResult = mysqli_query($conn, $insertQuery);
                            if ($insertResult) {
                                // Hapus data dari tb_gangguan setelah berhasil dipindahkan
                                $deleteQuery = "DELETE FROM tb_gangguan WHERE id_gangguan = '$id_gangguan'";
                                $deleteResult = mysqli_query($conn, $deleteQuery);
                                if ($deleteResult) {
                                    $message = '<script>alert("Data Berhasil Dipindahkan ke Laporan Gangguan dan dihapus dari Gangguan"); window.location="../gangguan";</script>';
                                } else {
                                    $message = '<script>alert("Gagal menghapus data dari Gangguan"); window.location="../gangguan";</script>';
                                }
                            } else {
                                $message = '<script>alert("Gagal memindahkan data ke laporan gangguan"); window.location="../gangguan";</script>';
                            }
                        } else {
                            $message = '<script>alert("Data gangguan tidak ditemukan"); window.location="../gangguan";</script>';
                        }
                    } else {
                        $message = '<script>alert("Data Berhasil Diperbarui"); window.location="../gangguan";</script>';
                    }
                } else {
                    $message = '<script>alert("Data gagal diperbarui"); window.location="../gangguan";</script>';
                }
            } else {
                $message = '<script>alert("Maaf, Terjadi Kesalahan File Tidak Dapat Diupload"); window.location="../gangguan";</script>';
            }
        }
    }
} else {
    $message = '<script>alert("ID Gangguan tidak valid"); window.location="../gangguan";</script>';
}

echo $message;
?>
