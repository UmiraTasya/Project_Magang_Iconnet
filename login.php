<?php
//session_start();
if (!empty($_SESSION['username_decafe'])) {
    header('location:home');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>SCHOON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">





    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-success {
            --bs-btn-color: #fff;
            --bs-btn-bg: #59C1BD;
            --bs-btn-border-color: #198754;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #59C1BD;
            --bs-btn-hover-border-color: #59C1BD;
            --bs-btn-focus-shadow-rgb: 60, 153, 110;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #59C1BD;
            --bs-btn-active-border-color: #13653f;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #198754;
            --bs-btn-disabled-border-color: #198754
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/login.css" rel="stylesheet">
</head>

<body>

    <main class="form-signin w-100 m-auto">
        <div class="card responsive " style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title text-center"><b>Login</b></h5>
                <div class="col-12 text-center">Hey, Enter you details to get Sign In</div>
                <div class="col-12 text-center">to your account</div>
                <form class="needs-validation mt-3" novalidate action="proses/proses_login.php" method="POST">
                    <div class="mb-3">
                        <p class="floatingInput mb-1"><b>Username</b></p>
                        <input class="form-control form-control-sm" type="text" name="username" placeholder="Masukan Username atau Email" required>
                        <div class="invalid-feedback">
                            Masukan Username 
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1"><b>Password</b></p>
                        <input class="form-control form-control-sm" type="password" name="password" placeholder="Masukan Password" required>
                        <div class="invalid-feedback">
                            Masukan Password Anda
                        </div>
                    </div>
                    <button class="w-100 btn btn-md btn-success" type="submit" name="submit_login" value="simpan">Sign in</button>
                </form>
            </div>
        </div>
    </main>


</body>

</html>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>