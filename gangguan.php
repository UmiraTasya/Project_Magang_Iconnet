<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_gangguan");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-10 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Gangguan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" style="background-color: #4CE1DB; border-color: #4CE1DB; color: #000;" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Data Gangguan</button>
                </div>
            </div>
            <!-- Modal Tambah User Gangguan Baru -->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Gangguan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_gangguan.php" method="POST" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="datetime-local" class="form-control" id="floatingInputTanggalMelapor" placeholder="Your tanggal" name="tanggal_melapor" required>
                                            <label for="floatingInputTanggalMelapor">Tanggal Melapor</label>
                                            <div class="invalid-feedback">
                                                Masukkan Tanggal Melapor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInputNama" placeholder="Your Name" name="nama" required>
                                            <label for="floatingInputNama">Nama</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInputIdPelanggan" placeholder="Your IdPelanggan" name="id_pelanggan" required>
                                            <label for="floatingInputIdPelanggan">Id Pelanggan</label>
                                            <div class="invalid-feedback">
                                                Masukkan Id Pelanggan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInputNoHp" placeholder="08xxxxx" name="no_hp" required>
                                            <label for="floatingInputNoHp">No Hp</label>
                                            <div class="invalid-feedback">
                                                Masukkan No Hp
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control py-3" id="uploadfoto" placeholder="Your Foto" name="foto" required>
                                            <label class="input-group-text" for="uploadfoto">Upload Foto ONT</label>
                                            <div class="invalid-feedback">
                                                Masukkan File Foto ONT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="status" required>
                                                <option selected hidden value="">Pilih Status</option>
                                                <option value="1">Belum Ditangani</option>
                                                <option value="2">Proses Penanganan</option>
                                                <option value="3">Selesai Perbaikan</option>
                                            </select>
                                            <label for="floatingSelectLevel">Status</label>
                                            <div class="invalid-feedback">
                                                Pilih Status
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="datetime-local" class="form-control" id="floatingInputTanggalPerbaikan" placeholder="Your Tanggal" name="tanggal_perbaikan">
                                            <label for="floatingInputTanggalPerbaikan">Tanggal Selesai Perbaikan</label>
                                            <div class="invalid-feedback">
                                                Masukkan Tanggal Perbaikan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_gangguan_validate" value="123456789">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah User Gangguan Baru -->


            <?php
            if (empty($result)) {
                echo "Data User Gangguan tidak ada";
            } else {
                foreach ($result as $row) {
            ?>
                    <!-- Modal View User Gangguan -->
                    <div class="modal fade" id="ModalView<?php echo $row['id_gangguan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">View Data Gangguan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_input_gangguan.php" method="POST" enctype="multipart/form-data">

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
                                            <div class="col-lg-4">
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
                    <!-- Akhir Modal User Gangguan View -->

                    <!-- Modal Edit User Gangguan -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_gangguan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Gangguan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_gangguan.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $row['id_gangguan'] ?>" name="id_gangguan">
                                        <input type="hidden" name="foto_lama" value="<?php echo $row['foto']; ?>">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="datetime-local" class="form-control" id="floatingInputTanggalMelapor" placeholder="Your tanggal" name="tanggal_melapor" required value="<?php echo $row['tanggal_melapor'] ?>">
                                                    <label for="floatingInputTanggalMelapor">Tanggal Melapor</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Tanggal Melapor
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInputNama" placeholder="Your Name" name="nama" required value="<?php echo $row['nama'] ?>">
                                                    <label for="floatingInputNama">Nama</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Nama
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInputIdPelanggan" placeholder="Your IdPelanggan" name="id_pelanggan" required value="<?php echo $row['id_pelanggan'] ?>">
                                                    <label for="floatingInputIdPelanggan">Id Pelanggan</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Id Pelanggan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInputNoHp" placeholder="08xxxxx" name="no_hp" required value="<?php echo $row['no_hp'] ?>">
                                                    <label for="floatingInputNoHp">No Hp</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan No Hp
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control py-3" id="uploadfoto" placeholder="Your Foto" name="foto">
                                                    <label class="input-group-text" for="uploadfoto">Upload Foto ONT</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan File Foto ONT
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" name="status" required>
                                                        <?php
                                                        // Data status dalam array
                                                        $statusList = array("Belum Ditangani", "Proses Penanganan", "Selesai Perbaikan");

                                                        // Loop melalui data status untuk membuat opsi
                                                        foreach ($statusList as $statusOption) {
                                                            // Periksa apakah opsi ini yang dipilih sebelumnya
                                                            $selected = ($statusOption == $row['status']) ? 'selected' : '';

                                                            echo "<option value='$statusOption' $selected>$statusOption</option>";
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
                                                    <input type="datetime-local" class="form-control" id="floatingInputTanggalPerbaikan" placeholder="Your Tanggal" name="tanggal_perbaikan" value="<?php echo $row['tanggal_perbaikan'] ?>">
                                                    <label for="floatingInputTanggalPerbaikan">Tanggal Selesai Perbaikan</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Tanggal Perbaikan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="input_gangguan_validate" value="123456789">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Edit User Gangguan-->

                    <!-- Modal Delete -->
                    <div class="modal fade" id="ModalDelete<?php echo $row['id_gangguan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete Data User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_delete_gangguan.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id_gangguan'] ?>" name="id_gangguan">
                                        <input type="hidden" value="<?php echo $row['foto'] ?>" name="foto">
                                        <div class="col-lg-12">
                                            Apakah Anda yakin ingin menghapus data user gangguan <b><?php echo $row['nama'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="input_user_validate" value="123456789">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Delete -->

                <?php
                }

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
                                <th scope="col">Foto ONT</th>
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
                                    <td>
                                        <div style="width: 90px">
                                            <img src="assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="...">
                                        </div>
                                    </td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td><?php echo $row['tanggal_perbaikan'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_gangguan'] ?>"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_gangguan'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_gangguan'] ?>"><i class="bi bi-trash-fill"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>