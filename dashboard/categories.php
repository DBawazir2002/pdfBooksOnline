<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
  header('Location:index.php');
  exit;
} else {


?>

  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->

  <!-- Start Delete category -->
  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM categories WHERE id = '$id'");
      $stmt->execute();
      $deleteSuccess = "<div class = 'alert alert-success'>"."تم حذف التصنيف بنجاح"."</div>";

  }
  ?>
  <!-- End Delete category -->

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $category = $_POST['category'];
    if(empty($category)){
      $catError = "<div class = 'alert alert-danger'>"."الرجاء ملء الحقل أدناه"."</div>";
    }
    else{
      $stmt = $con->prepare("INSERT INTO `categories` (`id`, `categoryName`, `categoryDate`) VALUES (NULL, '$category', current_timestamp())");
      $stmt->execute();
      $catSuccess = "<div class = 'alert alert-success'>"."تم اضافة التصنيف بنجاح"."</div>";
    }
  }
  
  ?>

  <div class="container-fluid">
    <!-- Start categories section -->
    <div class="categories">
      <?php 
        if(isset($catError)) {
          echo $catError;
        }
        if(isset($catSuccess)) {
          echo $catSuccess;
          header("REFRESH:0.5");
          exit();
        }
        
      ?>
      <div class="add-cat">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="form-group">
            <label for="cat">إضافة تصنيف :</label>
            <input type="text" id="cat" class="form-control" name="category">
          </div>
          <button class="custom-btn">إضافة</button>
        </form>
      </div>
      <div class="show-cat">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">الرقم</th>
              <th scope="col">عنوان التصنيف</th>
              <th scope="col">تاريخ الإضافة</th>
              <th scope="col">الإجراء</th>
            </tr>
          </thead>
          <tbody>
            <!-- Fetch categories from database -->
            <?php 
            $page;
            if(isset($_GET['page'])) {
              $page = $_GET['page'];
            }
            else {
              $page = 1;
            }
            $limit = 4;
            $start = ($page - 1) * $limit;
            $stmt = $con->prepare("SELECT * FROM categories ORDER BY id DESC LIMIT $start,$limit");
            $stmt->execute();
            $sNo = 0;
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $size = count($row);
            
            for($i = 0 ; $i < $size; $i++){
                
            ?>

              <tr>
                <td><?php echo $sNo+1; ?></td>
                <td><?php echo $row[$sNo]['categoryName']; ?></td>
                <td><?php echo $row[$sNo]['categoryDate']; ?></td>
                <td>
                  <a href="edit-cat.php?id=<?php echo $row[$sNo]['id']; ?>" class="custom-btn">تعديل</a>
                  <a href="categories.php?id=<?php echo $row[$sNo]['id']; ?>" class="custom-btn confirm">حذف</a>
                </td>
              </tr>
            <?php
            $sNo++;
            }
            ?>
          </tbody>
        </table>
        <!-- Start pagination -->
        <?php 
            $stmt = $con->prepare("SELECT * FROM categories");
            $stmt->execute();
            $total_cat = $stmt->rowCount();
            $total_pages = ceil($total_cat / $limit);   
        ?>

        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="categories.php?page=<?php if (($page - 1) > 0) {
                                                                                    echo  $page - 1;
                                                                                  } else {
                                                                                    echo 1;
                                                                                  }

                                                                                  ?>">السابق</a></li>
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
            ?>
              <li class="page-item"><a class="page-link" href="categories.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item"><a class="page-link" href="categories.php?page=<?php
                                                                                  if (($page + 1) < $total_pages) {
                                                                                    echo $page + 1;
                                                                                  } elseif (($page + 1) >= $total_pages) {
                                                                                    echo $total_pages;
                                                                                  }
                                                                                  ?>">التالي</a></li>
          </ul>
        </nav>
        <!-- End pagination -->
      </div>
    </div>
    <!-- End categories section -->
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
