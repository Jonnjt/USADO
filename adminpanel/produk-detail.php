<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM product a JOIN category b ON a.category_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$querykategori = mysqli_query($con, "SELECT * FROM category WHERE id!='$data[category_id]'");

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
    <title>Produk Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<style>
    .no-deco {
        text-decoration: none;
    }

    form div {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php" ?>

    <div class="container mt-5">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['category_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                        while ($datakategori = mysqli_fetch_array($querykategori)) {
                        ?>
                            <option value="<?php echo $datakategori['id']; ?>"><?php echo $datakategori['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" value="<?php echo $data['harga']; ?>" name="harga" class="form-control" required>
                </div>
                <div>
                    <label for="currentFoto">Foto Produk Sekarang</label>
                    <img src="../image/<?php echo $data['foto']; ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control" required><?php echo $data['detail']; ?></textarea>
                </div>
                <div>
                    <label for="kertersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="kertersediaan_stok" class="form-control">
                        <option value="<?php echo $data['ketersediaan_stok']; ?>"><?php echo $data['ketersediaan_stok']; ?></option>
                        <?php
                        if ($data['ketersediaan_stok'] == 'tersedia') {
                        ?>
                            <option value="habis">Habis</option>
                        <?php
                        } else {
                        ?>
                            <option value="tersedia">Tersedia</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-5 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Delete</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;

                if ($nama == '' || $kategori == '' || $harga == '' || $detail == '') {
            ?>
                    <div class="alert alert-danger mt-2" role="alert">
                        Wajib di isi semua
                    </div>
                    <?php
                } else {
                    $queryUpdate = mysqli_query($con, "UPDATE product SET category_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id=$id");

                    if ($nama_file != '') {
                        if ($image_size > 2000000) {
                    ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                File maks 2 mb
                            </div>
                        <?php
                        } else {
                            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                        ?>
                                <div class="alert alert-danger mt-2" role="alert">
                                    File wajib bertipe jpg atau png atau gif
                                </div>
                            <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                                $queryUpdate = mysqli_query($con, "UPDATE product SET foto='$new_name' WHERE id='$id'");

                                if ($queryUpdate) {
                            ?>
                                    <div class="alert alert-primary mt-2" role="alert">
                                        Produk berhasil di Update
                                    </div>

                                    <meta http-equiv="refresh" content="2; url = produk.php" />
                                <?php
                                } else {
                                    echo mysqli_error($con);
                                }
                            }
                        }
                    } else {
                        $queryUpdate = mysqli_query($con, "UPDATE product SET foto='$new_name' WHERE id='$id'");

                        if ($queryUpdate) {
                        ?>
                            <div class="alert alert-primary mt-2" role="alert">
                                Produk berhasil di Update
                            </div>

                            <meta http-equiv="refresh" content="2; url = produk.php" />
                        <?php
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }
            }

            if (isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($con, "DELETE FROM product  WHERE id='$id'");

                if ($queryHapus) {
                        ?>
                            <div class="alert alert-primary mt-2" role="alert">
                                Produk berhasil di Delete
                            </div> 

                            <meta http-equiv="refresh" content="2; url = produk.php" />
                        <?php
                }
            }

            ?>
        </div>
    </div>
</body>
</html>
