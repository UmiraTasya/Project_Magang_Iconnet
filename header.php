<?php 
include "proses/connect.php";
$query =mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$_SESSION[username_iconnet]'");
$records = mysqli_fetch_array($query);
?>

<nav class="navbar navbar-expand navbar-dark bg-custom sticky-top"> <!--Menggunakan kelas .bg-custom yang didefinisikan di CSS -->
    <div class="container-lg">
        <a class="navbar-brand" href="home"></i><span class="ms-2"><img src="assets/img/logo-removebg-preview.png" width="100px" height="30px" alt=""></a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $hasil['username']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile"><i class="bi bi-person-circle"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i class="bi bi-key-fill"></i> Ubah Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Ubah Password -->
<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_password.php" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $_SESSION['username_iconnet'] ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukkan Username
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="passwordlama" required>
                                <label for="floatingInput">Password Lama</label>
                                <div class="invalid-feedback">
                                    Masukkan Password Lama
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" name="passwordbaru" required>
                                <label for="floatingInput">Password Baru</label>
                                <div class="invalid-feedback">
                                    Masukkan Password Baru
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="repasswordbaru" required>
                                <label for="floatingInput">Ulangi Password Baru</label>
                                <div class="invalid-feedback">
                                    Ulangi Password Baru
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="ubah_password_validate" value="123456789">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Ubah Password-->


<!-- Modal Ubah Profile -->
<div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Ubah Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_profile.php" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $_SESSION['username_iconnet'] ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukkan Username
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingNama" name="nama" required value="<?php echo $records['nama'] ?>">
                                <label for="floatingInput">Nama</label>
                                <div class="invalid-feedback">
                                    Masukkan Nama Anda
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="jabatan" required value="<?php echo $records['jabatan'] ?>">
                                <label for="floatingInput">Jabatan</label>
                                <div class="invalid-feedback">
                                    Masukkan Jabatan Anda
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" name="nohp" required value="<?php echo $records['nohp'] ?>">
                                <label for="floatingInput">Nomor Hp</label>
                                <div class="invalid-feedback">
                                    Masukkan Nomor Hp Anda
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="" style="height:100px" name="alamat"><?php echo $records['alamat'] ?></textarea>
                                <label for="floatingInput">Alamat</label>
                                <div class="invalid-feedback">
                                    Masukkan Alamat Anda
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="ubah_profile_validate" value="123456789">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Ubah Profile -->