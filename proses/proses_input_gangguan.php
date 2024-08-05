<?php

include "connect.php";

$nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
$tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
$id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
$no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
$status = isset($_POST['status']) ? htmlentities($_POST['status']) : "";
$tanggal_perbaikan = isset($_POST['tanggal_perbaikan']) ? $_POST['tanggal_perbaikan'] : NULL;

// Array untuk memetakan ID status ke deskripsi teks
$statusList = [
    '1' => 'Belum Ditangani',
    '2' => 'Proses Penanganan',
    '3' => 'Selesai Perbaikan'
];

// Mendapatkan deskripsi teks dari ID status
$statusName = isset($statusList[$status]) ? $statusList[$status] : '';

$kode_rand = rand(10000, 99999) . "-";
$target_dir = "../assets/img/";
$target_file = $target_dir . $kode_rand . basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['input_gangguan_validate'])) {
    // Cek apakah file yang diupload adalah gambar
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = "Ini bukan file gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $message = "Maaf, file yang dimasukkan telah ada";
            $statusUpload = 0;
        } else {
            if ($_FILES['foto']['size'] > 5000000) { // 5 MB
                $message = "File foto yang diupload terlalu besar";
                $statusUpload = 0;
            } else {
                if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                    $message = "Maaf, hanya diperbolehkan gambar yang memiliki format JPG, JPEG, PNG, dan GIF";
                    $statusUpload = 0;
                }
            }
        }
    }

    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ', Gambar tidak dapat diupload ");
                window.location="../gangguan"</script>';
    } else {
        // Cek apakah ID pelanggan sudah ada di tb_gangguan
        $check_query = mysqli_query($conn, "SELECT * FROM tb_gangguan WHERE id_pelanggan = '$id_pelanggan'");
        if (mysqli_num_rows($check_query) > 0) {
            $message = '<script>alert("ID Pelanggan yang dimasukkan telah ada");
                        window.location="../gangguan"</script>';
        } else {
            // Jika status "Selesai Perbaikan", lakukan INSERT hanya ke tb_laporan_gangguan
            if ($status == '3') {
                $query_laporan = "INSERT INTO tb_laporan_gangguan (nama, tanggal_melapor, id_pelanggan, no_hp, status, tanggal_perbaikan, foto) VALUES (";
                $query_laporan .= "'$nama','$tanggal_melapor', '$id_pelanggan', '$no_hp', '$statusName'";

                // Handle the tanggal_perbaikan field
                if (!empty($tanggal_perbaikan)) {
                    $query_laporan .= ", '$tanggal_perbaikan'";
                } else {
                    $query_laporan .= ", NULL";
                }

                // Handle foto
                $query_laporan .= ", '$kode_rand" . $_FILES['foto']['name'] . "')";

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                    $result_laporan = mysqli_query($conn, $query_laporan);
                    if ($result_laporan) {
                        $message = '<script>alert("Data Berhasil Dimasukkan ke Laporan Gangguan");
                        window.location="../gangguan"</script>';
                    } else {
                        $message = '<script>alert("Data gagal dimasukkan ke Laporan Gangguan");
                        window.location="../gangguan"</script>';
                    }
                } else {
                    $message = '<script>alert("Maaf, Terjadi Kesalahan File Tidak Dapat Diupload");
                        window.location="../gangguan"</script>';
                }
            } else {
                // Jika status bukan "Selesai Perbaikan", lakukan INSERT hanya ke tb_gangguan
                $query_gangguan = "INSERT INTO tb_gangguan (foto, nama, tanggal_melapor, id_pelanggan, no_hp, status, tanggal_perbaikan) VALUES (";
                $query_gangguan .= "'$kode_rand" . $_FILES['foto']['name'] . "','$nama','$tanggal_melapor', '$id_pelanggan', '$no_hp', '$statusName'";

                // Handle the tanggal_perbaikan field
                if (!empty($tanggal_perbaikan)) {
                    $query_gangguan .= ", '$tanggal_perbaikan')";
                } else {
                    $query_gangguan .= ", NULL)";
                }
                
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                    $result_gangguan = mysqli_query($conn, $query_gangguan);
                    if ($result_gangguan) {
                        $message = '<script>alert("Data Berhasil Dimasukkan ke Gangguan");
                        window.location="../gangguan"</script>';
                    } else {
                        $message = '<script>alert("Data gagal dimasukkan ke Gangguan");
                        window.location="../gangguan"</script>';
                    }
                } else {
                    $message = '<script>alert("Maaf, Terjadi Kesalahan File Tidak Dapat Diupload");
                        window.location="../gangguan"</script>';
                }
            }
        }
    }
}
echo $message;





// include "connect.php";

// $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
// $tanggal_melapor = isset($_POST['tanggal_melapor']) ? $_POST['tanggal_melapor'] : "";
// $id_pelanggan = isset($_POST['id_pelanggan']) ? htmlentities($_POST['id_pelanggan']) : "";
// $no_hp = isset($_POST['no_hp']) ? htmlentities($_POST['no_hp']) : "";
// $status = isset($_POST['status']) ? htmlentities($_POST['status']) : "";
// $tanggal_perbaikan = isset($_POST['tanggal_perbaikan']) ? $_POST['tanggal_perbaikan'] : NULL;

// // Array untuk memetakan ID status ke deskripsi teks
// $statusList = [
//     '1' => 'Belum Ditangani',
//     '2' => 'Proses Penanganan',
//     '3' => 'Selesai Perbaikan'
// ];

// // Mendapatkan deskripsi teks dari ID status
// $statusName = isset($statusList[$status]) ? $statusList[$status] : '';

// $kode_rand = rand(10000, 99999) . "-";
// $target_dir = "../assets/img/" . $kode_rand;
// $target_file = $target_dir . basename($_FILES['foto']['name']);
// $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// if (!empty($_POST['input_gangguan_validate'])) {
//     // Cek apakah file yang diupload adalah gambar
//     $cek = getimagesize($_FILES['foto']['tmp_name']);
//     if ($cek === false) {
//         $message = "Ini bukan file gambar";
//         $statusUpload = 0;
//     } else {
//         $statusUpload = 1;
//         if (file_exists($target_file)) {
//             $message = "Maaf, file yang dimasukkan telah ada";
//             $statusUpload = 0;
//         } else {
//             if ($_FILES['foto']['size'] > 5000000) { // 5 MB
//                 $message = "File foto yang diupload terlalu besar";
//                 $statusUpload = 0;
//             } else {
//                 if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
//                     $message = "Maaf, hanya diperbolehkan gambar yang memiliki format JPG, JPEG, PNG, dan GIF";
//                     $statusUpload = 0;
//                 }
//             }
//         }
//     }

//     if ($statusUpload == 0) {
//         $message = '<script>alert("' . $message . ', Gambar tidak dapat diupload ");
//                 window.location="../gangguan"</script>';
//     } else {
//         $select = mysqli_query($conn, "SELECT * FROM tb_gangguan WHERE id_pelanggan = '$id_pelanggan'");
//         if (mysqli_num_rows($select) > 0) {
//             $message = '<script>alert("ID Pelanggan yang dimasukkan telah ada");
//         window.location="../gangguan"</script>';
//         } else {
//             $query = "INSERT INTO tb_gangguan (foto, nama, tanggal_melapor, id_pelanggan, no_hp, status, tanggal_perbaikan) VALUES (";
//             $query .= "'$kode_rand" . $_FILES['foto']['name'] . "','$nama','$tanggal_melapor', '$id_pelanggan', '$no_hp', '$statusName'";

//             // Handle the tanggal_perbaikan field
//             if (!empty($tanggal_perbaikan)) {
//                 $query .= ", '$tanggal_perbaikan')";
//             } else {
//                 $query .= ", NULL)";
//             }
            
//             if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
//                 $result = mysqli_query($conn, $query);
//                 if ($result) {
//                     $message = '<script>alert("Data Berhasil Dimasukkan");
//                     window.location="../gangguan"</script>';
//                 } else {
//                     $message = '<script>alert("Data gagal dimasukkan");
//                     window.location="../gangguan"</script>';
//                 }
//             } else {
//                 $message = '<script>alert("Maaf, Terjadi Kesalahan File Tidak Dapat Diupload");
//                     window.location="../gangguan"</script>';
//             }
//         }
//     }
// }
// echo $message;
?>
