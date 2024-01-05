<?php
    session_start();
    include 'include/connection.php';
    include 'include/header.php';
    if(!isset($_SESSION['adminInfo'])){
        header('Location:index.php');
    }
else{
    

  ?>

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

      <div class="container-fluid">
       <?php 
          $stmt = $con->prepare("SELECT * FROM admin");
          $stmt->execute();
          $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        ?>
        
                <?php
            if(isset($_POST['edit']))  {
                $adminName = $_POST['adminName'];
                $adminEmail = $_POST['adminEmail'];
                $adminPass = $_POST['adminPass'];
                
                $stmt = $con->prepare("UPDATE admin SET
                adminName = '$adminName',
                adminEmail = '$adminEmail',
                adminPass = '$adminPass'
                WHERE id = '1'");
                $stmt->execute();
                header("REFRESH:0");
                exit();
            }
        ?>
        <div class="profile">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="name">الإسم</label>
                    <input type="text" class="form-control" id="name" value="<?php  echo $row[0]['adminName']; ?>" name="adminName">
                </div>
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="text" class="form-control" id="email"  value="<?php  echo $row[0]['adminEmail']; ?>" name="adminEmail">
                </div>
                <div class="form-group">
                    <label for="pass">كلمة السر</label>
                    <input type="text" class="form-control" id="pass"  value="<?php  echo $row[0]['adminPass']; ?>" name="adminPass">
                </div>
                <button class="custom-btn" name="edit">تعديل البيانات</button>
            </form>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
<?php
  include 'include/footer.php';
 ?>


<?php 
    }
?>