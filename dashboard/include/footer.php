<!--jQuery-->
<script src="js/jquery-3.6.0.js"></script>
<!--Font Awesome-->
<script src="https://kit.fontawesome.com/03757ac844.js"></script>
<!--Bootstrap-->
<script src="js/bootstrap.min.js"></script>
<script src="tiny/ "></script>
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
<script>
    $('.confirm').click(function() {
        return confirm("هل أنت متأكد ؟");
    });
</script>
</body>

</html>