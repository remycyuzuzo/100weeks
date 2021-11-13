<?php
include "./admin/dependencies.php";

# check whether the session/cookie is set, if not, redirect the page to the login page
if (isset($_SESSION['logged_in'])) {
    echo "<script>window.location='" . URL . "/admin/dashboard.php'</script>";
} else {
?><script>
        window.location = '<?= URL ?>/login.php'
    </script> <?php
            }
