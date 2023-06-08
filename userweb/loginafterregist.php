<?php
    session_start();
    require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   
</head>
<style>
      .main{
        height: 100vh;
      }  
      .login-box{
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        border-radius: 10px;
      }
      .btn{
        background-color:#3C3744;
        border-color: #3C3744;
      }
      .btn:hover{
        background-color: black;
        border-color: black;
      }
      .form-control{
        border: solid 1px;
      }
</style>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow ">
            <form action="" method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="text" class= "form-control mt-2 mb-2" placeholder="example@gmail.com" name = "email" id="email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class= "form-control mt-2" name = "password" id="password">
                </div>
                <div>
                    <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
                </div>
                
            </form>
        </div>
        <div class="mt-3" style=" width: 500px" >
            <?php
            if (isset($_POST['loginbtn'])){
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($con, "SELECT * FROM user_web WHERE email = '$email'");
                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);

                if($countdata>0){
                        if (password_verify($password, $data['password'])) {
                            echo "benar";
                            $_SESSION['email'] = $data['email'];
                            $_SESSION['login'] = true;
                                header('location:../index.php');
                        }else{
                            ?>
                            <div class="alert alert-warning" role="alert">Password salah</div>
                            <?php
                        }
                }else{
                    ?>
                    <div class="alert alert-warning" role="alert">Akun salah</div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</body>
</html>