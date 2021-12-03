<?php
require "./dependencies.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= FAVICON ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?= BOOTSTRAP_CSS ?>">
    <link rel="stylesheet" href="<?= FONTAWESOME ?>">
    <link rel="stylesheet" href="<?= URL ?>/res/css/general-css.css">
    <link rel="stylesheet" href="<?= URL ?>/res/css/admin-styles.css">
    <title>Sample page</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <?php include "./includes/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include "./includes/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">
            <div class="container">
                <div class="title">
                    <h3>Register a new mentor/coach</h3>
                </div>
                <div class="form">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First name" name="fname">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last name" name="lname">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="ID card number" name="lname">
                        </div>
                    </form>
                </div>

            </div>
        </main>
        <!-- ./main-contents -->

        <!-- footer -->
        <footer></footer>
        <!-- ./end of footer -->
    </div>

    <!-- JAVASCRIPT FILES -->
    <script src="<?= URL ?>/res/js/admin-sidebar.js"></script>
    <script src="<?= BOOTSTRAP_JS ?>"></script>
</body>

</html>