<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_pergantian_sandi");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-10 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman User Pergantian Sandi Wifi
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" style="background-color: #4CE1DB; border-color: #4CE1DB; color: #000;" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Data Pergantian Sandi</button>
                </div>
            </div>
            <!-- Modal Tambah User Ganti Sandi Baru -->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data User yang ingin melakukan pergantian sandi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_ganti_sandi.php" method="POST">
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
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInputNoHp" placeholder="08xxxxx" name="no_hp" required>
                                            <label for="floatingInputNoHp">No Hp</label>
                                            <div class="invalid-feedback">
                                                Masukkan No Hp
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInputNamaWifi" placeholder="nama wifi" name="nama_wifi" required>
                                            <label for="floatingInputNamaWifi">Nama Wifi</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Wifi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInputPasswordBaru" placeholder="password baru" name="password_baru" required>
                                            <label for="floatingInputPasswordBaru">Password Baru</label>
                                            <div class="invalid-feedback">
                                                Masukkan Password Baru
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
                                    <button type="submit" class="btn btn-primary" name="input_ganti_sandi_validate" value="123456789">Save changes</button>
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
                    <!-- Modal View User Pergantian Sandi -->
                    <div class="modal fade" id="ModalView<?php echo $row['id_ganti_sandi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">View Data Pergantian Sandi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_input_ganti_sandi.php" method="POST">
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
                                                    <input type="text" class="form-control" id="floatingInputNamaWifi" value="<?php echo $row['nama_wifi'] ?>" disabled>
                                                    <label for="floatingInputNamaWifi">Nama Wifi</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Nama Wifi
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInputPasswordBaru" value="<?php echo $row['password_baru'] ?>" disabled>
                                                    <label for="floatingInputPasswordBaru">Password Baru</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Password Baru
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
                    <!-- Akhir Modal User Ganti Sandi View -->

                    <!-- Modal Edit User Ganti Sandi -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_ganti_sandi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pergantian Sandi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_ganti_sandi.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id_ganti_sandi'] ?>" name="id_ganti_sandi">
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
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInputNoHp" placeholder="08xxxxx" name="no_hp" required value="<?php echo $row['no_hp'] ?>">
                                                    <label for="floatingInputNoHp">No Hp</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan No Hp
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInputNamaWifi" placeholder="nama wifi" name="nama_wifi" required value="<?php echo $row['nama_wifi'] ?>">
                                                    <label for="floatingInputNamaWifi">Nama Wifi</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Nama Wifi
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInputPasswordBaru" placeholder="password baru" name="password_baru" required value="<?php echo $row['password_baru'] ?>">
                                                    <label for="floatingInputPasswordBaru">Password Baru</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Password Baru
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
                                            <button type="submit" class="btn btn-primary" name="input_ganti_sandi_validate" value="123456789">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Edit User Gangguan-->

                    <!-- Modal Delete -->
                    <div class="modal fade" id="ModalDelete<?php echo $row['id_ganti_sandi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete Data Pergantian Sandi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_delete_ganti_sandi.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id_ganti_sandi'] ?>" name="id_ganti_sandi">
                                        <div class="col-lg-12">
                                            Apakah Anda yakin ingin menghapus data user pergantian sandi <b><?php echo $row['nama'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete_ganti_sandi_validate" value="123456789">Hapus</button>
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
                <!-- Tabel Data Pergantian Sandi  -->
                <div class="table-responsive mt-2">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Tanggal Melapor</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Id Pelanggan</th>
                                <th scope="col">No Hp</th>
                                <th scope="col">Nama Wifi</th>
                                <th scope="col">Password Baru</th>
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
                                    <td><?php echo $row['nama_wifi'] ?></td>
                                    <td><?php echo $row['password_baru'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td><?php echo $row['tanggal_perbaikan'] ?></td>

                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_ganti_sandi'] ?>"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_ganti_sandi'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_ganti_sandi'] ?>"><i class="bi bi-trash-fill"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Akhir Tabel Data Pergantian Sandi  -->
            <?php
            }
            ?>
        </div>
    </div>
</div>