<?php
include "layout/include/header.php";
?>
<!--End navbar -->

<!-- Start banar-->
<div class="banar" style="height: 50vh;">
    <div class="overlay"></div>
    <div class="lib-info">
        <h4>حمّل عشرات الكتب مجانا</h4>
        <p>من اجل نشر المعرفة والثقافة , وغرس حب القراءة بين المتحدثين باللغة العربية</p>
    </div>
</div>
<!-- End banar-->

<!-- Start Books-->
<div class="books">
    <div class="container">
        <div class="row">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $limit = 8;
            $start = ($page - 1) * $limit;

            $stmt = $con->prepare("SELECT * FROM books ORDER BY id DESC LIMIT $start,$limit");
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
            ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="img-cover">
                                <img src="uploads/bookCovers/<?php echo $row[$i]['bookCover']; ?>" alt="Book cover" class="card-img-top">
                            </div>
                            <div class="card-book">
                                <h4 class="card-title">
                                    <a href="book.php?id=<?php echo $row[$i]['id']; ?>&&category=<?php echo $row[$i]['bookCat']; ?>"><?php echo $row[$i]['bookTitle']; ?></a>
                                </h4>
                                <p class="card-text"><?php echo mb_substr($row[$i]['bookContent'], 0, 150, "UTF-8"); ?></p>
                                <button class="custom-btn">
                                    <a href="book.php?id=<?php echo $row[$i]['id']; ?>&&category=<?php echo $row[$i]['bookCat']; ?>">تحميل الكتاب</a>
                                </button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "لا توجد اي كتب";
            }
            ?>



        </div>
    </div>
</div>
<!-- End Books-->


<!-- Start pagination -->
<?php
$stmt = $con->prepare("SELECT * FROM books");
$stmt->execute();
$total_cat = $stmt->rowCount();
$total_pages = ceil($total_cat / $limit);
?>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="index.php?page=<?php if (($page - 1) > 0) {
                                                                                echo  $page - 1;
                                                                            } else {
                                                                                echo 1;
                                                                            }

                                                                            ?>">السابق</a></li>
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
        ?>
            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php
        }
        ?>
        <li class="page-item"><a class="page-link" href="index.php?page=<?php
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
include "layout/include/footer.php";
?>