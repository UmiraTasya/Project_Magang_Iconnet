<?php
session_start();
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page ="home.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'user') {
    if($_SESSION['level_iconnet']==1){
        $page ="user.php";
        include "main.php";
    }else{
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'gangguan') {
    if($_SESSION['level_iconnet']==1){
        $page ="gangguan.php";
        include "main.php";
    }else{
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'gantisandi') {
    if($_SESSION['level_iconnet']==1){
        $page ="gantisandi.php";
        include "main.php";
    }else{
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'ubahlayanan') {
    if($_SESSION['level_iconnet']==1){
        $page ="ubahlayanan.php";
        include "main.php";
    }else{
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'deaktivasi') {
    if($_SESSION['level_iconnet']==1){
        $page ="deaktivasi.php";
        include "main.php";
    }else{
        $page = "home.php";
        include "main.php";
    }
    
} elseif (isset($_GET['x']) && $_GET['x'] == 'laporan') {
    $page ="laporan.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
    include "login.php";
}elseif (isset($_GET['x']) && $_GET['x'] == 'logout') {
    include "proses/proses_logout.php";
}else {
    $page ="home.php";
    include "main.php";
}

?>
