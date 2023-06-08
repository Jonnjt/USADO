<?php
    require "session.php";
    require "../koneksi.php";

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM product a JOIN category b ON a.category_id=b.id");
    $jumlahproduk = mysqli_num_rows($query);

    $querykategori = mysqli_query($con, "SELECT * FROM category");

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

</head>

<style>
    .no-deco{
        text-decoration: none;
    }
    form div{
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-deco">
                    <i class="fas fa-home" ></i> Home </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                   <i class="fas fa-align-justify" ></i> Produk
                </li>
            </ol>
        </nav>
        <div class="my-5 col-12 col-md-6">
        <h3>Tambah Produk</h3>

        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" autocomplete="off" required>
            </div>
            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required >
                    <option value="">Pilih</option>
                    <?php 
                        while($data= mysqli_fetch_array($querykategori)){
                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" required>
            </div>
            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <div>
                <label for="kertersediaan_stok">Kertersediaan Stok</label>
                <select name="kertersediaan_stok" id="kertersediaan_stok"  class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option></select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
        </form>
        <?php 
            if(isset($_POST['simpan'])){
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $kertersediaan_stok = htmlspecialchars($_POST['kertersediaan_stok']);
               
                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;
            
                if($nama=='' || $kategori=='' || $harga=='' || $detail=='' ){
        ?>
                <div class="alert alert-danger mt-2" role="alert">
                    Wajib di isi semua
                </div>
        <?php
                }
                else{
                    if($nama_file!=''){
                        if($image_size > 2000000){
        ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                File maks 2 mb
                            </div>
        <?php
                        }
                        else{
                            if($imageFileType!= 'jpg' && $imageFileType!= 'png' && $imageFileType!= 'gif' ){
        ?>
                                <div class="alert alert-danger mt-2" role="alert">
                                    File wajib bertipe jpg atau png atau gif
                                </div>
        <?php
                            }
                            else{
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                            }
                        }
                    }
                    
                    //query insert to produk table
                    $queryTambah = mysqli_query($con, "INSERT INTO product (category_id, nama, harga, foto, 
                    detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail'
                    , '$kertersediaan_stok')");

                    if($queryTambah){
        ?>
                        <div class="alert alert-primary mt-2" role="alert">
                            Produk berhasil disimpan
                        </div> 

                        <meta http-equiv="refresh" content="2; url = produk.php" />
        <?php
                    }
                    else{
                      echo mysqli_error($con);  
                    }
                }
            }
        ?>

        </div>

        <div class="mt-3 mb-6">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Ketesediaan Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahproduk==0){
                        ?>
                            <tr>
                                <td colspan="6" class = "text-center">Data produk tidak tersedia</td>
                            </tr>
                        <?php      
                            }
                            $jumlah = 1;
                            while($data = mysqli_fetch_array($query)){
                        ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                <td><?php echo $data['harga']; ?></td>
                                <td><?php echo $data['ketersediaan_stok']; ?></td>
                                <td>
                                    <a href="produk-detail.php?p=<?php echo $data ['id']; ?>" 
                                    class = "btn btn-info"><i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                        <?php
                            $jumlah++;
                            }
                        ?>

                    </tbody>
                </table>
        </div>    
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>

</body>
</html>