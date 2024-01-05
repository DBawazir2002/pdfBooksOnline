<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
  header('Location:index.php');
} else {


?>

  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->

  <div class="container-fluid">
    <div class="content">
      <div class="statistics text-center">
        <div class="row">
          <div class="col-sm-6">
            <div class="statistic">
              <?php
              $stmt = $con->prepare("SELECT id FROM books");
              $stmt->execute();
              $bookNum = $stmt->rowCount();
              ?>
              <h3><?php echo $bookNum; ?></h3>
              <p>عدد الكتب</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="statistic">
              <?php
              $stmt = $con->prepare("SELECT id FROM categories");
              $stmt->execute();
              $catNum = $stmt->rowCount();
              ?>
              <h3><?php echo $catNum; ?></h3>
              <p>عدد التصنيفات</p>
            </div>

          </div>
        </div>
      </div>
      <?php 

        if($bookNum > 0){
      ?>
      <div class="statistics text-center">
        <div class="statistic">

          <div class="show-cat">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">الرقم</th>
                  <th scope="col">عنوان الكتاب</th>
                  <th scope="col">المؤلف</th>
                  <th scope="col">التصنيف</th>
                  <th scope="col">تاريخ الإضافة</th>
                </tr>
              </thead>
              <tbody>
                <!-- Fetch last book inserted from database -->
                <?php
                $stmt = $con->prepare("SELECT * FROM books");
                $stmt->execute();
                $ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $lastId = $ids[$stmt->rowCount() - 1]['id'];
                $numOflastId = $stmt->rowCount();
                $stmt = $con->prepare("SELECT * FROM books WHERE id = '$lastId'");
                $stmt->execute();
                $lastBook = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>

                <tr>
                  <td><?php echo $numOflastId; ?></td>
                  <td><?php echo $lastBook['bookTitle']; ?></td>
                  <td><?php echo $lastBook['bookAuthor']; ?></td>
                  <td><?php echo $lastBook['bookCat']; ?></td>
                  <td><?php echo $lastBook['bookDate']; ?></td>
                </tr>
              </tbody>
            </table
            >
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
<?php 

}

?>
  <!-- /#wrapper -->
  <?php
  include 'include/footer.php';
  ?>


<?php
}
?>