<?php
    require "session.php";
    require "koneksi.php";
    $queryproduk = mysqli_query($con, "SELECT id, nama, foto, detail, harga FROM product LIMIT 6");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usado | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all/min.css">
    <link rel="stylesheet" href="css/Style.css">

</head>
<body>
    
    <?php require "Navbar.php"; ?>

    <div class="container-fluid banners d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>USADO THRIFT SHOP</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipients's username" aria-describedby="basic-addon2" name="keyword">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg warna3 text-white">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>

            <div class="row mt-5 ">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori1 d-flex justify-content-center align-items-center">
                    <h4 class="text-white "><a class="no-decoration" href="produk.php?kategori=Pria">Pria</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori2 d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Wanita">Wanita</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori3 d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Sepatu">Sepatu</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid warna3 py-5">
        <div class="container text-center desc-us">
            <h2>Tentang Kami</h2>
            <p class="fs-5 mt-3">USADO adalah Website yang memudahkan para costumer untuk mencari dan membeli barang Trifting dan Bal lalu dikirimkan ke tempat tujuan customer lainnya. Calon customer yang dituju adalah orang yang terjun atau suka dalam ranah fashion.</p>
        </div>
    </div>

    <!--produk-->
        <!--produk-->
        <div class="container-fluid py-5">
            <div class="container text-center">
            <h3>Produk</h3>
            <div class="row mt-5">    
                <?php while($data = mysqli_fetch_array($queryproduk)){?>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                            <img class="card-img-top" src="image/<?php echo $data ['foto']; ?>" alt="Card image">
                            </div>
                            <div class="card-body">
                            <h4 class="card-title"><?php echo $data ['nama']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $data ['detail']; ?></p>
                            <p class="card-text text-harga">Rp <?php echo $data ['harga']; ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data ['nama']; ?>" class="btn btn-warning">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
            <a class="btn btn-outline-warning mt-3 p-3" href="produk.php">See More</a>
        </div>
    </div>  
    <?php require "Footer.php"; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>