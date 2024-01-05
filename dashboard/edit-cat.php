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

    <!-- Fetch categoryName form database -->
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

    
        $stmt = $con->prepare("SELECT * FROM categories WHERE id = '$id'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <!-- Edit category -->
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryName =  $_POST['category'];
        $stmt = $con->prepare("UPDATE categories SET categoryName = '$categoryName' WHERE id = '$id' ");
        $stmt->execute();
        header('Location:categories.php');
    }
    ?>

    <div class="container-fluid">
        <div class="edit-cat">
            <form action="edit-cat.php?id=<?php echo $row['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="cat">تعديل التصنيف</label>
                    <input type="text" class="form-control" id="cat" value="<?php echo $row['categoryName']; ?>" name="category">
                </div>
                <button class="custom-btn">تعديل</button>
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