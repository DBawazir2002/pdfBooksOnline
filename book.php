    <?php 
        include "layout/include/header.php";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
    ?>
    <!--End navbar -->

    <!-- Start show book-->
    <div class="books">
        <div class="container">
            <div class="book">
                <div class="row">
                    <?php 
                        $stmt = $con->prepare("SELECT * FROM books WHERE id = '$id'");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    ?>
                    <div class="col-md-4">
                        <div class="book-cover">
                            <img src="uploads/bookCovers/<?php echo $row['bookCover']; ?>" alt="Book cover" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="book-content">
                            <h4><?php echo $row['bookTitle']; ?></h4>
                            <h5><a href="author.php?author=<?php echo $row['bookAuthor'];?>"><?php echo $row['bookAuthor']; ?></a></h5>
                            <hr/>
                            <p><?php echo $row['bookContent']; ?></p>
                            <button class="custom-btn" style="width: 160px;">
                                <a href="uploads/books/<?php echo $row['book']; ?>" download>تحميل الكتاب</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End show book -->
    
    <!-- Start Related Books -->
   <div class="related-books">
    <div class="container">
        <h4>كتب ذات صلة</h4>
        <hr/>
        <div class="row">
            <?php
            $bookCat = '';
                if(isset($_GET['category'])){
                    $bookCat = $_GET['category'];
                    
                }
                //fetch related books
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $limit = 6;
                $start = ($page - 1) * $limit;
                $stmt = $con->prepare("SELECT * FROM books WHERE bookCat = '$bookCat' AND id !='$id' ORDER BY id DESC LIMIT $start,$limit");
                $stmt->execute();
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            
            <div class="col-lg-3 col-md-4 col-6">
                <div class="related-book text-center">
                <div class="card text-center">
                            <div class="img-cover">
                                <img src="uploads/bookCovers/<?php echo $row['bookCover']; ?>" alt="Book cover" class="card-img-top">
                            </div>
                            <div class="card-book">
                                <h4 class="card-title">
                                    <a href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>"><?php echo $row['bookTitle']; ?></a>
                                </h4>
                                <button class="custom-btn">
                                    <a href="book.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['bookCat']; ?>">تحميل الكتاب</a>
                                </button>
                            </div>
                        </div>

                </div>
            </div>
            <?php

                }
            ?>
            

           

            
            
        </div>
    </div>
   </div>
    <!-- End Releated Books-->


     <!-- Start pagination -->
     <?php
    $stmt = $con->prepare("SELECT * FROM books WHERE bookCat = '$bookCat' AND id !='$id'");
    $stmt->execute();
    $total_cat = $stmt->rowCount();
    $total_pages = ceil($total_cat / $limit);
    ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="book.php?id=<?php echo $id; ?>&&category=<?php echo $bookCat?>&&page=<?php if (($page - 1) > 0) {
                                                                                    echo  $page - 1;
                                                                                } else {
                                                                                    echo 1;
                                                                                }

                                                                                ?>">السابق</a></li>
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
            ?>
                <li class="page-item"><a class="page-link" href="book.php?id=<?php echo $id; ?>&&category=<?php echo $bookCat?>&&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item"><a class="page-link" href="book.php?id=<?php echo $id; ?>&&category=<?php echo $bookCat?>&&page=<?php
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