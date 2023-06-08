<?php 
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryproduk = mysqli_query($con, "SELECT * FROM product WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryproduk);

    $queryProdukTerkait = mysqli_query($con, "SELECT * FROM product WHERE category_id='$produk[category_id]' AND id!='$produk[id]' LIMIT 4");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usado | Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all/min.css">
    <link rel="stylesheet" href="css/Style.css">

</head>
<body>
    <?php require "Navbar.php"; ?>

    <div class="container-fluid py-5" >
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5">
                    <img src="image/<?php echo $produk['foto'];?>" class="w-100" >
                </div>
                <div class="col-lg-6 offset-lg-1" >
                <h1><?php echo $produk['nama'];?></h1>
                <p class="fs-5" ><?php echo $produk['detail'];?></p>
                <p class="text-harga" >Rp <?php echo $produk['harga'];?></p>
                <p class="fs-5">Status Keterdesiaan: <strong><?php echo $produk['ketersediaan_stok'];?></strong></p>
                <a href="keranjang.php"><i class="fa-solid fa-cart-shopping icon-shop"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 warna3" >
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Tekait</h2>
            <div class="row">
            <?php while ($data=mysqli_fetch_array($queryProdukTerkait)){ ?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama'];?>">
                    <img src="image/<?php echo $data['foto'];?>" class="img-fluid img-thumbnail produk-terkait-img">
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php require "Footer.php"; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
