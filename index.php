<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = mysqli_query($koneksi,
    "SELECT * FROM warga
    WHERE username='$username'
    AND password='$password'");

    $cek = mysqli_num_rows($login);

    if($cek > 0){

        $data = mysqli_fetch_array($login);

        $_SESSION['nama'] = $data['nama'];
        $_SESSION['id'] = $data['id'];

        header("Location: dashboard.php");

    }else{

        echo "
        <script>
        alert('Username atau Password salah');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: #198754;
}

.card{
    border-radius: 20px;
}

</style>

</head>
<body>

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body">

                    <h2 class="text-center text-success mb-4">

                    LOGIN WARGA

                    </h2>

                    <form method="POST">

                        <div class="mb-3">

                            <label>Username</label>

                            <input type="text"
                            name="username"
                            class="form-control">

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input type="password"
                            name="password"
                            class="form-control">

                        </div>

                        <button type="submit"
                        name="login"
                        class="btn btn-success w-100">

                        Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>