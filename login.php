<?php 
   /* session_start();
    include 'dashboard/include/connection.php';
    include 'layout/include/header.php';
    // check if session isset
    if(isset($_SESSION['adminEmail'])){
        header('Location:dashboard/index.php');
    }
    else{
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول</title>
    <!-- Bootstrap and Bootstrap Rtl -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="css/dashboard.css">

<style>
  .login{
    width: 300px;
    margin: 80px auto;
    font-family: janna lt;
  }
  .login h5{
    color: #555;
    margin-bottom: 30px;
    margin-top: 10px;
    text-align: center;
  }
  .login button{
    margin-right: 80px;
    padding: 5px;
    width: 140px;
    background: #00b593;
    border: 1px solid #00b593;
    color: #fff;
  }
  .lo{
    margin-bottom: 400px;
  }
</style>

</head>

<body>

  <div class="login">
<!-- Log to dashboard  -->
   <?php 
    if(isset($_POST['log'])) {
      $adminEmail = $_POST['adminEmail'];

      if(empty($adminEmail))
        {
          echo "<div class = 'alert alert-danger'>"."الرجاء ملء الحقل أدناه"."</div>";
        }
        else{
          $stmt = $con->prepare("SELECT * FROM admin WHERE adminEmail = '$adminEmail'");
          $stmt->execute();
          if($stmt->rowCount() > 0) {
            $_SESSION['adminEmail'] = $adminEmail;
            header('Location:dashboard/index.php');
          }
           else{
            echo "<div class = 'alert alert-danger'>"."البريد الإلكتروني غير صحيح"."</div>";
           } 
        
        }



    }
   
   
   
   ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <h5>تسجيل الدخول</h5>
      <div class="form-group">
        <label for="mail"> البريد الإلكتروني</label>
        <input type="text" class="form-control"  id="mail" name="adminEmail"/>
      </div>
      <button class="custom-btn" name="log">تسجيل الدخول</button>
    </form>
  </div>
    <div class="lo">

    </div>
  <?php
    include 'layout/include/footer.php';
  ?>


<?php
    }
?>*/