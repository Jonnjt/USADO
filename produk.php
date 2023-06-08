<?php 
    require "koneksi.php";
    $querykategori = mysqli_query($con,"SELECT * FROM category");

    //produk by nama
    if(isset($_GET ['keyword'])){
        $queryproduk = mysqli_query($con,"SELECT * FROM product WHERE nama LIKE'%$_GET[keyword]%'");
    }
    //by kategori
    else if(isset($_GET ['kategori'])){
        $queryGetKategoriId = mysqli_query($con,"SELECT id FROM category WHERE nama='$_GET[kategori]'");
        $kategoriId = mysqli_fetch_array($queryGetKategoriId);
        $queryproduk = mysqli_query($con, "SELECT * FROM product WHERE category_id='$kategoriId[id]'");
    }
    //default
    else{
        $queryproduk = mysqli_query($con,"SELECT * FROM product");
    }

    $countData = mysqli_num_rows($queryproduk);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usado | Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all/min.css">
    <link rel="stylesheet" href="css/Style.css">  
</head>
<body>
<?php require "Navbar.php"; ?>

    <div class="container-fluid banners2 d-flex align-items-center" >
        <div class="container text-center text-white">
            <h1>Produk</h1>
        </div>
    </div>
    <div class="container py-5" >
        <div class="row" >
            <div class="col-lg-3 mb-5">
                <h3 class="mb-3" >Kategori</h3>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($querykategori)){ ?>
                    <a class="a-kategori" href="produk.php?kategori=<?php echo $kategori ['nama']; ?>">
                    <li class="list-group-item"><?php echo $kategori ['nama']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9 ">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php
                    if ($countData<1){ ?>
                        <div class="alert alert-warning my-4 mx-auto text-center w-50" role="alert">Maaf, produk tidak tersedia</div>
                    <?php } ?>
                        <?php while ($produk = mysqli_fetch_array($queryproduk)) {?>
                        <div class="col-md-4 mb-4" >
                            <div class="card h-100">
                                <div class="image-box">
                                    <img class="card-img-top" src="image/<?php echo $produk['foto'];?>" alt="Card image">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title text-truncate"><?php echo $produk['nama'];?></h4>
                                    <p class="card-text text-truncate"><?php echo $produk['detail'];?></p>
                                    <p class="card-text text-harga">Rp <?php echo $produk['harga'];?></p>
                                    <a href="produk-detail.php?nama=<?php echo $produk['nama'];?>" class="btn btn-warning">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php require "Footer.php"; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>