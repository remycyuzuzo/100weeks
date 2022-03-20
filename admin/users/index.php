<?php
require $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
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
    <title>100weeks - Manage system users</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <?php include ROOT . "/admin/includes/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include ROOT . "/admin/includes/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">
            <div class="container">
                <div class="card wrapper">
                    <div class="card-body">
                        <?php
                        if (isset($_GET["coach-registered-successful"])) {
                            echo "<div class=\"alert alert-success\" data-disappearing><i class='fas fa-check-circle'></i> The new coach registered successful \t &nbsp; <a href=\"#\" class='close'>dismiss</a></div>";
                        }

                        ?>
                        <div class="title">
                            <h3 class="mb-0"><i class="fas fa-users"></i> System users</h3>
                        </div>

                        <div class="my-4">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Inbox
                                    <span class="badge badge-primary badge-pill">12</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Ads
                                    <span class="badge badge-primary badge-pill">50</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Junk
                                    <span class="badge badge-primary badge-pill">99</span>
                                </li>
                            </ul>

                        </div>
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

    <script>
        const disappearingAlert = document.querySelector("[data-disappearing] .close")
        if (disappearingAlert) {
            disappearingAlert.onclick = (e) => {
                e.preventDefault()
                disappearingAlert.parentElement.remove()
            }
        }
    </script>

</body>

</html>