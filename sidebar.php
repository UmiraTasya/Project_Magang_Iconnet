<div class="col-lg-2">
    <nav class="navbar navbar-expand-lg sidebar-custom rounded border mt-2 fixed-sidebar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start sidebar-custom" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width:250px">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo ((isset($_GET['x']) && $_GET['x']=='home') || !isset($_GET['x'])) ? 'active link-light' : 'link-dark' ; ?>" aria-current="page" href="home"><i class="bi bi-house-add"></i> Home</a>
                        </li>
                        <?php if($hasil['level']==1){ ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='user') ? 'active link-light' : 'link-dark' ; ?>" href="user"><i class="bi bi-person"></i> User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='gangguan') ? 'active link-light' : 'link-dark' ; ?>" href="gangguan"><i class="bi bi-wifi-off"></i> Gangguan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='pergantiansandi') ? 'active link-light' : 'link-dark' ; ?>" href="pergantiansandi"><i class="bi bi-router"></i> Pergantian Sandi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='ubahlayanan') ? 'active link-light' : 'link-dark' ; ?>" href="ubahlayanan"><i class="bi bi-arrow-up-circle"></i> Ubah Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='deaktivasi') ? 'active link-light' : 'link-dark' ; ?>" href="deaktivasi"><i class="bi bi-person-fill-slash"></i> Deaktivasi</a>
                        </li>
                        <?php } ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle ps-2 <?php echo (isset($_GET['x']) && ($_GET['x']=='laporan' || $_GET['x']=='laporangangguan' || $_GET['x']=='laporanpergantiansandi' || $_GET['x']=='laporanubahlayanan' || $_GET['x']=='laporandeaktivasi')) ? 'active link-light' : 'link-dark' ; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-journal-text"></i> Laporan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item <?php echo (isset($_GET['x']) && $_GET['x']=='laporangangguan') ? 'active' : '' ; ?>" href="laporangangguan">Gangguan</a></li>
                                <li><a class="dropdown-item <?php echo (isset($_GET['x']) && $_GET['x']=='laporanpergantiansandi') ? 'active' : '' ; ?>" href="laporanpergantiansandi">Pergantian Sandi</a></li>
                                <li><a class="dropdown-item <?php echo (isset($_GET['x']) && $_GET['x']=='laporanubahlayanan') ? 'active' : '' ; ?>" href="laporanubahlayanan">Ubah Layanan</a></li>
                                <li><a class="dropdown-item <?php echo (isset($_GET['x']) && $_GET['x']=='laporandeaktivasi') ? 'active' : '' ; ?>" href="laporandeaktivasi">Deaktivasi</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<style>
/* Pastikan dropdown memiliki lebar yang sama dengan item menu induk */
.nav-item.dropdown .dropdown-menu {
    width: 100%;
}

/* Sidebar tetap */
.fixed-sidebar {
    position: fixed;
    top: 50px; /* Sesuaikan dengan tinggi header Anda */
    left: 0;
    height: calc(102vh - 102px); /* Sesuaikan berdasarkan tinggi header dan footer Anda */
    overflow-y: auto;
    z-index: 1020;
    width: 200px; /* Pastikan ini sesuai dengan lebar sidebar */
    padding-top: 10px;
    margin-right: 20px; /* Contoh penambahan margin kanan */
}

@media (max-width: 991.98px) {
    .fixed-sidebar {
        position: static;
        width: 100%;
        height: auto;
    }
    .offcanvas {
        width: 100%; /* Pastikan offcanvas menutupi seluruh lebar layar pada perangkat kecil */
    }
}
</style>





<!-- <div class="col-lg-3">
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
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='pergantiansandi') ? 'active link-light' : 'link-dark' ; ?>" href="pergantiansandi"><i class="bi bi-router"></i> Pergantian Sandi</a>
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
            </div> -->


            