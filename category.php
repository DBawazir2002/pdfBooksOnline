<?php
include 'layout/include/header.php';
?>

<?php
if (isset($_GET['categoryName'])) {
    $categoryName = $_GET['categoryName'];
    $stmt = $con->prepare("SELECT * FROM books WHERE bookCat = '$categoryName'");
    if($stmt->rowCount() == 0) {


?>

    <div class="books">
        <div class="container">
            <!--       
                    هذا الون جميل جدا    
    <div class="bg-warning"></div> -->
            <div class="bg-secondary text-white p-2 mb-3">
                <h4><span>تصنيف: </span>
                    <span><?php echo $categoryName; ?></span>
                </h4>
            </div>
            <div class="row">
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $limit = 6;
                $start = ($page - 1) * $limit;

                $stmt = $con->prepare("SELECT * FROM books WHERE bookCat = '$categoryName' ORDER BY id DESC LIMIT $start,$limit");
                $stmt->execute();
                $catNum = $stmt->rowCount();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="img-cover">
                                <img src="uploads/bookCovers/<?php echo $row['bookCover']; ?>" alt="Book cover" class="card-img-top">
                            </div>
                            <div class="card-book">
                                <h4 class="card-title">
                                    <a href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>"><?php echo $row['bookTitle']; ?></a>
                                </h4>
                                <p class="card-text"><?php echo mb_substr($row['bookContent'], 0, 150, "UTF-8"); ?></p>
                                <button class="custom-btn">
                                    <a href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>">تحميل الكتاب</a>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>



    <!-- Start pagination -->
    <?php
    $stmt = $con->prepare("SELECT * FROM books WHERE bookCat = '$categoryName'");
    $stmt->execute();
    $total_cat = $stmt->rowCount();
    $total_pages = ceil($total_cat / $limit);
    ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="category.php?page=<?php if (($page - 1) > 0) {
                                                                                    echo  $page - 1;
                                                                                } else {
                                                                                    echo 1;
                                                                                }

                                                                                ?>">السابق</a></li>
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
            ?>
                <li class="page-item"><a class="page-link" href="category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item"><a class="page-link" href="category.php?page=<?php
                                                                                if (($page + 1) < $total_pages) {
                                                                                    echo $page + 1;
                                                                                } elseif (($page + 1) >= $total_pages) {
                                                                                    echo $total_pages;
                                                                                }
                                                                                ?>">التالي</a></li>
        </ul>
    </nav>
    <!-- End pagination -->


<?php
}
else{
?>
<div class="bg-secondary text-white p-2 mb-3">
                <h4><span>تصنيف: </span>
                    <span><?php echo $categoryName; ?></span>
                </h4>
            </div>
<div class="alert alert-danger">لا تتوفر كتب من تصنيف <span><?php echo $categoryName; ?></span> في الوقت الحالي</div>
<?php
} 
}
else
{
?>

    <div class="container-fluid">
        <div class="content">
            <div class="statistics text-center" style="margin-top: 30px;
    margin-bottom: 30px;">
                <div class="row">
                    <?php
                    $page;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $limit = 8;
                    $start = ($page - 1) * $limit;
                    $stmt = $con->prepare("SELECT * FROM categories ORDER BY id DESC LIMIT $start,$limit");
                    $stmt->execute();
                    while ($bookCat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="col-sm-6 cat-cont">
                            <div class="statistic" style="  background: #fff;
                                                            border: 1px solid #eee;
                                                            padding: 20px;
                                                            margin-bottom: 20px;">
                                <h4><a href="category.php?categoryName=<?php echo $bookCat['categoryName']; ?>"><?php echo $bookCat['categoryName']; ?></a></h4>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>






    <!-- Start pagination -->
    <?php
    $stmt = $con->prepare("SELECT * FROM categories");
    $stmt->execute();
    $total_cat = $stmt->rowCount();
    $total_pages = ceil($total_cat / $limit);
    ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="category.php?page=<?php if (($page - 1) > 0) {
                                                                                    echo  $page - 1;
                                                                                } else {
                                                                                    echo 1;
                                                                                }

                                                                                ?>">السابق</a></li>
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
            ?>
                <li class="page-item"><a class="page-link" href="category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item"><a class="page-link" href="category.php?page=<?php
                                                                                if (($page + 1) < $total_pages) {
                                                                                    echo $page + 1;
                                                                                } elseif (($page + 1) >= $total_pages) {
                                                                                    echo $total_pages;
                                                                                }
                                                                                ?>">التالي</a></li>
        </ul>
    </nav>
    <!-- End pagination -->


    <?php
    include 'layout/include/footer.php';
    ?>

<?php
}
?>