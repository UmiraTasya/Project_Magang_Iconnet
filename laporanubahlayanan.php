<?php
include "proses/connect.php";

// Mendapatkan tanggal mulai dan tanggal akhir dari form
$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';

// Menyesuaikan query untuk rentang tanggal
if ($startDate && $endDate) {
    // Menggunakan BETWEEN dengan INTERVAL untuk menyertakan tanggal akhir
    $query = mysqli_query($conn, "SELECT * FROM tb_laporan_ubah_layanan WHERE tanggal_melapor BETWEEN '$startDate' AND DATE_ADD('$endDate', INTERVAL 1 DAY)");
} else {
    $query = mysqli_query($conn, "SELECT * FROM tb_laporan_ubah_layanan");
}

$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-10 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Laporan Ubah Layanan
        </div>
        <div class="card-body">

            <form method="POST" class="mb-3" id="searchForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $startDate; ?>">
                            <label for="start_date">Tanggal Mulai</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $endDate; ?>">
                            <label for="end_date">Tanggal Selesai</label>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Cari</button>
                        <button type="button" class="btn btn-secondary" onclick="resetSearch()">Kembali</button>
                    </div>
                </div>
            </form>

            <?php
            if (empty($result)) {
                echo "Data Laporan User Ubah layanan tidak ada";
            } else {
            ?>
                <div class="table-responsive mt-2">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Tanggal Melapor</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Id Pelanggan</th>
                                <th scope="col">No Hp</th>
                                <th scope="col">Layanan Lama</th>
                                <th scope="col">Layanan Baru</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Perbaikan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['tanggal_melapor'] ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['id_pelanggan'] ?></td>
                                    <td><?php echo $row['no_hp'] ?></td>
                                    <td><?php echo $row['layanan_lama'] ?></td>
                                    <td><?php echo $row['layanan_baru'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td><?php echo $row['tanggal_perbaikan'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_laporan_ubah_layanan'] ?>"><i class="bi bi-eye"></i> View</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal View User Laporan Ubah Layanan -->
                                <div class="modal fade" id="ModalView<?php echo $row['id_laporan_ubah_layanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">View Data Ubah Layanan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="needs-validation" novalidate action="proses/proses_input_ubah_layanan.php" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="datetime-local" class="form-control" id="floatingInputTanggalMelapor" value="<?php echo $row['tanggal_melapor'] ?>" disabled>
                                                                <label for="floatingInputTanggalMelapor">Tanggal Melapor</label>
                                                                <div class="invalid-feedback">
                                                                    Masukkan Tanggal Melapor
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" id="floatingInputNama" value="<?php echo $row['nama'] ?>" disabled>
                                                                <label for="floatingInputNama">Nama</label>
                                                                <div class="invalid-feedback">
                                                                    Masukkan Nama
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" id="floatingInputIdPelanggan" value="<?php echo $row['id_pelanggan'] ?>" disabled>
                                                                <label for="floatingInputIdPelanggan">Id Pelanggan</label>
                                                                <div class="invalid-feedback">
                                                                    Masukkan Id Pelanggan
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="number" class="form-control" id="floatingInputNoHp" value="<?php echo $row['no_hp'] ?>" disabled>
                                                                <label for="floatingInputNoHp">No Hp</label>
                                                                <div class="invalid-feedback">
                                                                    Masukkan No Hp
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" id="floatingInputLayananLama" value="<?php echo $row['layanan_lama'] ?>" disabled>
                                                                <label for="floatingInputLayananLama">Layanan Lama</label>
                                                                <div class="invalid-feedback">
                                                                    Masukkan Layanan Lama
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" id="floatingInputLayananBaru" value="<?php echo $row['layanan_baru'] ?>" disabled>
                                                                <label for="floatingInputLayananBaru">Layanan Baru</label>
                                                                <div class="invalid-feedback">
                                                                    Masukkan Layanan Baru
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <select disabled class="form-select" aria-label="Default select example" name="status" id="">
                                                                    <?php
                                                                    // Data status dalam array
                                                                    $data = array("Belum Ditangani", "Proses Penanganan", "Selesai Perbaikan");

                                                                    // Loop melalui data status untuk membuat opsi
                                                                    foreach ($data as $value) {
                                                                        if ($row['status'] == $value) {
                                                                            echo "<option selected value='$value'>$value</option>";
                                                                        } else {
                                                                            echo "<option value='$value'>$value</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <label for="floatingInput">Status</label>
                                                                <div class="invalid-feedback">
                                                                    Pilih Status
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="datetime-local" class="form-control" id="floatingInputTanggalPerbaikan" value="<?php echo $row['tanggal_perbaikan'] ?>" disabled>
                                                                <label for="floatingInputTanggalPerbaikan">Tanggal Selesai Perbaikan</label>
                                                                <div class="invalid-feedback">
                                                                    Masukkan Tanggal Perbaikan
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal User Laporan Ubah Layanan View -->
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Tombol Cetak -->
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-success" onclick="printTable()">Cetak</button>
                </div>

                <!-- Formulir Cetak -->
                <div id="printForm" class="d-none">
                    <div class="text-center">
                        <img src="assets/img/logo-removebg-preview.png" alt="Logo" width="100" style="margin-bottom: 20px;">
                        <h2 style="margin-bottom: 10px;">PT PLN ICON PLUS LHOKSEUMAWE</h2>
                        <p>JL. Merdeka, No. 2, Cunda, Kota Lhokseumawe, 24351</p>
                        <hr style="width: 100%; margin-top: 20px; margin-bottom: 20px; border-top: 2px solid black;">
                    </div>
                    <h4>Data User Mengubah Layanan</h4>
                    <p>Tanggal Mulai: <?php echo $startDate; ?> - Tanggal Selesai: <?php echo $endDate; ?></p>
                    <table class="table table-hover" style="border: 1px solid black; border-collapse: collapse;">
                        <thead>
                            <tr style="border: 1px solid black;">
                                <th scope="col" style="border: 1px solid black;">No</th>
                                <th scope="col" style="border: 1px solid black;">Tanggal Melapor</th>
                                <th scope="col" style="border: 1px solid black;">Nama</th>
                                <th scope="col" style="border: 1px solid black;">Id Pelanggan</th>
                                <th scope="col" style="border: 1px solid black;">No Hp</th>
                                <th scope="col" style="border: 1px solid black;">Layanan Lama</th>
                                <th scope="col" style="border: 1px solid black;">Layanan Baru</th>
                                <th scope="col" style="border: 1px solid black;">Status</th>
                                <th scope="col" style="border: 1px solid black;">Tanggal Perbaikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;"><?php echo $no++ ?></td>
                                    <td style="border: 1px solid black;"><?php echo $row['tanggal_melapor'] ?></td>
                                    <td style="border: 1px solid black;"><?php echo $row['nama'] ?></td>
                                    <td style="border: 1px solid black;"><?php echo $row['id_pelanggan'] ?></td>
                                    <td style="border: 1px solid black;"><?php echo $row['no_hp'] ?></td>
                                    <td style="border: 1px solid black;"><?php echo $row['layanan_lama'] ?></td>
                                    <td style="border: 1px solid black;"><?php echo $row['layanan_baru'] ?></td>
                                    <td style="border: 1px solid black;"><?php echo $row['status'] ?></td>
                                    <td style="border: 1px solid black;"><?php echo $row['tanggal_perbaikan'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <style>
                        .top-text {
                            margin-top: 50px;
                            /* Atur jarak atas sesuai kebutuhan */
                        }
                    </style>

                    <p class="top-text">.......................... , ............................</p>
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <p>Manager KP Lhokseumawe</p>
                        </div>
                        <div class="text-end">
                            <p>Customer Care</p>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<style>
    @media print {

        #printForm table,
        #printForm th,
        #printForm td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    }
</style>

<script>
    function resetSearch() {
        document.getElementById('start_date').value = '';
        document.getElementById('end_date').value = '';
        document.getElementById('searchForm').submit();
    }

    function printTable() {
        var printContents = document.getElementById('printForm').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>