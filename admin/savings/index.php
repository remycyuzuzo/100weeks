<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "admin/dependencies.php";
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
    <title>100Weeks - Payments</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <?php include $_SERVER["DOCUMENT_ROOT"] . "admin/includes/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include $_SERVER["DOCUMENT_ROOT"] . "admin/includes/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">
            <div class="form-overlay overflow-auto d-none">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="form-container">Please wait..</div>
                </div>
            </div>
            <div class="container">
                <div class="card wrapper">
                    <div class="card-header">
                        <h3>Savings</h3>
                    </div>
                    <div class="card-body">
                        <div class="tab-nav">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" data-savingtab="new-savings" href="#">Register savings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-savingtab="saving-history" href="#">view saving history</a>
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
    <script src="<?= URL ?>/res/js/savings-tabs.js" type="module"></script>
    <script src="<?= BOOTSTRAP_JS ?>"></script>
</body>

</html>