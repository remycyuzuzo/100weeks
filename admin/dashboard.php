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
    <title>100Weeks | Dashboard</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <?php include __DIR__ . "/includes/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include "./includes/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">
            <div class="container">
                <h3>Month: <?= date("M Y") ?></h3>
                <h4>general summary</h4>

                <div class="summary-cards">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div><b>54</b> new notifications</div>
                                    <span>
                                        <a href="#">view more <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div><b>54</b> parishes</div>
                                    <span>
                                        <a href="#">view more <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class=""><b>545</b> VSLAs</div>
                                    <span>
                                        <a href="#">view more <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div><b>2617</b> members</div>
                                    <span>
                                        <a href="#">view more <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./row -->
                </div><!-- ./summary-cards -->
                <div class="my-3">
                    <div class="card">
                        <div class="card-body"></div>
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
    <script src="<?= URL ?>/res/js/admin-sidebar.js"></script>
    <script src="<?= BOOTSTRAP_JS ?>"></script>
</body>

</html>