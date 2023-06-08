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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
        <h2>Halo <?php echo $_SESSION['username']; ?></h2>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                            <div class="col-6" >
                                <i class="fas fa-align-justify fa-7x" ></i>
                            </div>
                            <div class="col-6" >
                                <h3 class="fs-2" >Kategori</h3>
                                <p class="fs-4" ><?php echo $jumlahKategori; ?> Kategori</p>
                                <p><a href="kategori.php " class="no-deco"  >Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3" >
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6" >
                                <i class="fas fa-box fa-7x" ></i>
                            </div>
                            <div class="col-6" >
                                <h3 class="fs-2" >produk</h3>
                                <p class="fs-4" ><?php echo $jumlahProduk ?> Produk</p>
                                <p><a href="produk.php " class="no-deco"  >Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js" ></script>
    <script src="../fontawesome/js/all.min.js" ></script>
</body>
</html>