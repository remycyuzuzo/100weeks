<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
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
    <title>Loans</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">
            <div class="container">
                <div class="card wrapper">
                    <div class="card-header">
                        <h3>Savings</h3>
                    </div>
                    <div class="card-body">

                        <div class="results">
                            <?php if (isset($_GET['successfully-added'])) { ?>
                                <div class="alert alert-success">
                                    The VSLA group was added
                                    <span class="close"></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="tab-nav">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" data-loantab="active-loans" href="#">active loans</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-loantab="new-loan" href="#">Register loan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-contents"></div>
                    </div>
                </div>

            </div>
        </main>
        <!-- ./main-contents -->

        <!-- footer -->
        <footer></footer>
        <!-- ./end of footer -->
    </div>

    <!-- JAVASCRIPT FILES -->
    <script src="<?= AXIOS ?>"></script>
    <script src="<?= URL ?>/res/js/admin-sidebar.js"></script>
    <script src="<?= BOOTSTRAP_JS ?>"></script>

    <!-- scripts that manages tabs and load data accordings on the loans page -->
    <script src="<?= URL ?>/res/js/loan-page.js" type="module"></script>

</body>

</html>