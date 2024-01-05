<?php
include "layout/include/header.php";
if (isset($_GET['author'])) {
    $bookAuthor = $_GET['author'];
}
?>
<!--End navbar -->

<div class="books">
<div class="container">
    <!--       
                    هذا الون جميل جدا    
    <div class="bg-warning"></div> -->
    <div class="author-info bg-secondary text-white p-2 mb-3">
        <span>جميع كتب</span>
        <span><?php echo $bookAuthor;?></span>
    </div>
    <div class="row">
        <?php
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }
        $limit = 6;
        $start = ($page - 1) * $limit;
        $stmt = $con->prepare("SELECT * FROM books WHERE bookAuthor = '$bookAuthor' ORDER BY id DESC LIMIT $start,$limit");
        $stmt->execute();
        $total_cat = $stmt->rowCount();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>

            <div class="col-md-6 col-lg-4">
                <div class="card text-center">
                    <div class="img-cover">
                        <img src="uploads/bookCovers/<?php echo $row['bookCover']; ?>" alt="Book cover" class="card-img-top">
                    </div>
                    <div class="card-book">
                        <h4 class="card-title">
                            <a href="book.php?id=<?php echo $row['id'];?>&&category=<?php echo $row['bookCat'];?>"><?php echo $row['bookTitle']; ?></a>
                        </h4>
                        <p class="card-text"><?php echo mb_substr($row['bookContent'], 0, 150, "UTF-8"); ?></p>
                        <button class="custom-btn">
                            <a href="book.php?id=<?php echo $row['id'];?>&&category=<?php echo $row['bookCat'];?>">تحميل الكتاب</a>
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
    $total_pages = ceil($total_cat / $limit);
    ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="author.php?author=<?php echo $bookAuthor;?>&&page=<?php if (($page - 1) > 0) {
                                                                                    echo  $page - 1;
                                                                                } else {
                                                                                    echo 1;
                                                                                }

                                                                                ?>">السابق</a></li>
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
            ?>
                <li class="page-item"><a class="page-link" href="author.php?author=<?php echo $bookAuthor;?>&&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item"><a class="page-link" href="author.php?author=<?php echo $bookAuthor;?>&&page=<?php
                                                                                if (($page + 1) < $total_pages) {
                                                                                    echo $page + 1;
                                                                                } elseif (($page + 1) >= $total_pages) {
                                                                                    echo $total_pages;
                                                                                }
                                                                                ?>">التالي</a></li>
        </ul>
    </nav>
    <!-- End pagination -->



<!-- Start Footer-->
<?php
include "layout/include/footer.php";
?>