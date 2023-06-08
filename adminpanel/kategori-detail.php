<?php
    require "session.php";
    require"../koneksi.php";

    $id = $_GET['q'];

    $query = mysqli_query($con, "SELECT *FROM category WHERE id = '$id'");
    $data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>
    <?php require "navbar.php"?>

    <div class="container mt-5">
    <h2>Detail Kategori</h2>
    <div class="col-12 col-md-6">
        <form action="" method ="post">
        <div>
            <label for="kategori">Kategori</label>
                <input type="text" name = "kategori" id = "kategori" class ="from-control" 
                value="<?php echo $data ['nama'] ?>">
        </div>

         <div class="mt-5 d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" name="editBtn" > Edit</button>
            <button type="submit" class="btn btn-danger" name="deleteBtn" > Delete</button>
         </div>
        </form>


        <?php
            if (isset($_POST['editBtn'])){
                $kategori = htmlspecialchars($_POST['kategori']);

                if ($data['nama']==$kategori){
                    ?>
                    <meta http-equiv="refresh" content="2; url = kategori.php" />
                                        
                    <?php  
                }
                else{
                    $query = mysqli_query($con, "SELECT * FROM category WHERE nama='$kategori'");
                    $jumlahData = mysqli_num_rows($query);

                    if($jumlahData > 0){
                        ?>

                        <div class="alert alert-danger mt-2" role="alert">
                            Kategori sudah ada
                        </div>
                        <?php
                    }
                    else{
                        $querySimpan = mysqli_query($con, "UPDATE category SET nama='$kategori' WHERE id='$id'");
                        
                        if($querySimpan){
                            ?>
                             <div class="alert alert-success mt-2" role="alert">
                                 Kategori Berhasil TerUpdate
                            </div>

                            <meta http-equiv="refresh" content="2; url = kategori.php" />
                            <?php
    
                        }
                        else{
                            echo mysqli_error($con);
                        }
    
                    }
                }
            }

            if(isset($_POST['deleteBtn'])){
                $queryCheck = mysqli_query($con, "SELECT * FROM product WHERE category_id='$id'");
                $dataCount = mysqli_num_rows($queryCheck);

                if($dataCount > 0){
                    ?>
                         <div class="alert alert-warning mt-2" role="alert">
                            Kategori tidak bisa di hapus karena sudah di gunakan di produk
                        </div>
                    <?php
                    die();
                }
                
                $queryDelete = mysqli_query($con, "DELETE FROM category WHERE id='$id'");
                
                if($queryDelete){
                    ?>
                        <div class="alert alert-success mt-2" role="alert">
                             Kategori Berhasil DiDelete
                        </div>

                        <meta http-equiv="refresh" content="2; url = kategori.php" />

                <?php
                }
                else{
                    echo mysqli_error($con);
                }
                
            }
        ?>
        
    </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js" ></script>

</body>
</html>