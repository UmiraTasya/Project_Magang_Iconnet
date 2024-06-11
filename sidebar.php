<div class="col-lg-3">
                <nav class="navbar navbar-expand-lg sidebar-custom rounded border mt-2">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-start sidebar-custom" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width:250px">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo ((isset($_GET['x']) && $_GET['x']=='home') || !isset($_GET['x'])) ? 'active link-light' : 'link-dark' ; ?>" aria-current="page" href="home"><i class="bi bi-house-add"></i> Home</a>
                                    </li>
                                    <?php if($hasil['level']==1){ ?>
                                        <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='user') ? 'active link-light' : 'link-dark' ; ?>" href="user"><i class="bi bi-person"></i></i> User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='gangguan') ? 'active link-light' : 'link-dark' ; ?>" href="gangguan"><i class="bi bi-wifi-off"></i> Gangguan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='gantisandi') ? 'active link-light' : 'link-dark' ; ?>" href="gantisandi"><i class="bi bi-router"></i> Ganti Sandi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='ubahlayanan') ? 'active link-light' : 'link-dark' ; ?>" href="ubahlayanan"><i class="bi bi-arrow-up-circle"></i> Ubah Layanan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='deaktivasi') ? 'active link-light' : 'link-dark' ; ?>" href="deaktivasi"><i class="bi bi-person-fill-slash"></i> Deaktivasi</a>
                                    </li>
                                    <?php } ?>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='laporan') ? 'active link-light' : 'link-dark' ; ?>" href="laporan"><i class="bi bi-journal-text"></i> Laporan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>


            