<?php
    require "session.php";
    require"../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM category");
    $jumlahKategori = mysqli_num_rows($queryKategori);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
     .no-deco{
        text-decoration: none;
    }
    .no-deco:hover{    
        background-color: white;
        color: black;
        border-radius: 2px;
    }
    .form-control{
        border: solid 2px;
    }
</style>

<body>
    <?php require "navbar.php";?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-deco">
                    <i class="fas fa-home" ></i> Home </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                   <i class="fas fa-align-justify" ></i> Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>

            <form action="" method ="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id = "kategori" name = "kategori" placeholder="input nama kategori"
                    class="form-control mt-3">
                </div>
                <div class ="mt-4">
                    <button class ="btn btn-primary" type = "sumbit" name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan_kategori'])){
                    $kategori =htmlspecialchars($_POST['kategori']);

                    $queryExist = mysqli_query($con,"SELECT nama FROM category WHERE nama = '$kategori'");
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                    if($jumlahDataKategoriBaru > 0){
            ?>
                <div class="alert alert-danger mt-2" role="alert">
                    Kategori sudah ada
                </div>
            <?php
                    }
                    else{
                        $querySimpan = mysqli_query($con, "INSERT INTO category (nama) VALUES ('$kategori')");
                    
                    if($querySimpan){
                        ?>
                         <div class="alert alert-success mt-2" role="alert">
                             Kategori Berhasil Tersimpan
                        </div>
                        <meta http-equiv="refresh" content="2; url = kategori.php" />
                        <?php

                    }
                    else{
                        echo mysqli_error($con);
                    }

                    }
                }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($jumlahKategori == 0){
          
                        ?>
                                <tr>
                                    <td colspan="3" class = "text-center">Tidak ada data Kategori</td>
                                </tr>
                        <?php
                                }
                                else{
                                    $jumlah = 1;
                                    while($data = mysqli_fetch_array($queryKategori)){
                        ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data ['nama']; ?></td>
                                <td>
                                    <a href="kategori-detail.php?q= <?php  echo $data ['id'] ?>" 
                                    class = "btn btn-info"><i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                        <?php
                                 $jumlah++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js" ></script>
    <script src="../fontawesome/js/all.min.js" ></script>

</body>
</html>