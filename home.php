<?php
include "proses/connect.php";

// Inisialisasi array
$resultGangguan = [];
$resultSandi = [];
$resultLayanan = [];
$resultDeaktivasi = [];

// Ambil data laporan gangguan
$queryGangguan = mysqli_query($conn, "SELECT * FROM tb_laporan_gangguan");
while ($rowGangguan = mysqli_fetch_array($queryGangguan)) {
    $resultGangguan[] = $rowGangguan;
}

// Ambil data laporan pergantian sandi
$querySandi = mysqli_query($conn, "SELECT * FROM tb_laporan_pergantian_sandi");
while ($rowSandi = mysqli_fetch_array($querySandi)) {
    $resultSandi[] = $rowSandi;
}

// Ambil data laporan ubah layanan
$queryLayanan = mysqli_query($conn, "SELECT * FROM tb_laporan_ubah_layanan");
while ($rowLayanan = mysqli_fetch_array($queryLayanan)) {
    $resultLayanan[] = $rowLayanan;
}

// Ambil data laporan deaktivasi
$queryDeaktivasi = mysqli_query($conn, "SELECT * FROM tb_laporan_deaktivasi");
while ($rowDeaktivasi = mysqli_fetch_array($queryDeaktivasi)) {
    $resultDeaktivasi[] = $rowDeaktivasi;
}
?>

<div class="col-lg-10 mt-2">
    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <?php
            $slide = 0;
            $firstSlideButton = true;
            foreach ($resultGangguan as $dataTombol) {
                ($firstSlideButton) ? $aktif = "active" : $aktif = "";
                $firstSlideButton = false;
            ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $slide ?>" class="<?php echo $aktif ?>" aria-current="true" aria-label="Slide <?php echo $slide + 1 ?>"></button>
            <?php
                $slide++;
            } ?>
        </div>
        <div class="carousel-inner rounded">
            <?php
            $firstSlide = true;
            foreach ($resultGangguan as $data) {
                ($firstSlide) ? $aktif = "active" : $aktif = "";
                $firstSlide = false;
            ?>
                <div class="carousel-item <?php echo $aktif ?>">
                    <img src="assets/img/<?php echo $data['foto'] ?>" class="img-fluid" style="height: 500px; width:100%; object-fit:cover" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $data['nama'] ?></h5>
                        <p><?php echo $data['tanggal_melapor'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Akhir Carousel -->

    <div class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <h5 class="card-title">ICONNET CARE - SISTEM PENGINPUTAN DATA KELUHAN PELANGGAN BERBASIS WEB</h5>
            <p class="card-text">Berikut adalah data terbaru: Pelanggan yang mengalami gangguan layanan, Pengguna yang telah mengganti sandi mereka, Pengguna yang telah memperbarui atau mengubah layanan, dan Pengguna yang telah menonaktifkan akun mereka.
            </p>
            <a href="laporangangguan" class="btn btn-primary">Lihat Data </a>
        </div>
    </div>

    <!-- Kotak Data -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center bg-primary text-white h-100">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="fa fa-wrench fa-3x mb-3"></i>
                    <h5 class="card-title">Data Gangguan</h5>
                    <p class="card-text"><?php echo count($resultGangguan); ?> laporan</p>
                    <a href="laporangangguan" class="btn btn-light mt-auto">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center bg-success text-white h-100">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="fa fa-key fa-3x mb-3"></i>
                    <h5 class="card-title">Data Pergantian Sandi</h5>
                    <p class="card-text"><?php echo count($resultSandi); ?> laporan</p>
                    <a href="laporanpergantiansandi" class="btn btn-light mt-auto">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center bg-info text-white h-100">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="fa fa-exchange-alt fa-3x mb-3"></i>
                    <h5 class="card-title">Data Ubah Layanan</h5>
                    <p class="card-text"><?php echo count($resultLayanan); ?> laporan</p>
                    <a href="laporanubahlayanan" class="btn btn-light mt-auto">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center bg-danger text-white h-100">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="fa fa-user-slash fa-3x mb-3"></i>
                    <h5 class="card-title">Data Deaktivasi</h5>
                    <p class="card-text"><?php echo count($resultDeaktivasi); ?> laporan</p>
                    <a href="laporandeaktivasi" class="btn btn-light mt-auto">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Kotak Data -->

    <!-- Tempatkan elemen canvas di tempat yang Anda inginkan untuk menampilkan chart -->
    <div class="col-lg-12 mt-4">
        <div class="card">
            <div class="card-body">
                <canvas id="dataChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Pastikan untuk menambahkan link ke FontAwesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<?php
// Persiapkan data untuk chart
$gangguanCount = count($resultGangguan);
$sandiCount = count($resultSandi);
$layananCount = count($resultLayanan);
$deaktivasiCount = count($resultDeaktivasi);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('dataChart').getContext('2d');
    var dataChart = new Chart(ctx, {
        type: 'bar', // Tipe chart, bisa diganti dengan 'line', 'pie', dll.
        data: {
            labels: ['Gangguan', 'Pergantian Sandi', 'Ubah Layanan', 'Deaktivasi'],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [
                    <?php echo $gangguanCount; ?>,
                    <?php echo $sandiCount; ?>,
                    <?php echo $layananCount; ?>,
                    <?php echo $deaktivasiCount; ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
