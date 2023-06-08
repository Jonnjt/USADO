<?php
    require "session.php";
    require"../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT *  FROM category");
    $jumlahKategori = mysqli_num_rows($queryKategori);


    $queryProduk = mysqli_query($con, "SELECT *  FROM product");
    $jumlahProduk = mysqli_num_rows($queryProduk);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<style>
    .kotak{
        border: solid;
    }
    .summary-kategori{
        background-color: #282A3A;
        color: white;
        border-radius: 13px;
    }
    .summary-produk{
        background-color: #282A3A;
        color: white;
        border-radius: 13px;
    }
    .no-deco{
        text-decoration: none;
        color: white;
    }
    .no-deco:hover{    
        background-color: white;
        color: black;
        border-radius: 2px;
    }
</style>
<body>
    <?php
        require "navbar.php";
    ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                   <i class="fas fa-home" ></i> Home
                </li>
            </ol>
        </nav>
        <h2>Halo <?php echo $_SESSION['email']; ?></h2>
        <div class="container mt-5">
            </div>
        </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js" ></script>
    <script src="../fontawesome/js/all.min.js" ></script>
</body>
</html>