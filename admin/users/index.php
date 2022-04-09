<?php

use DBError as GlobalDBError;

require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/classUser.php";

if (!class_exists("DBError")) {
    class DBError extends Exception
    {
    }
}

$user = new User();
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
            <div class="container-fluid">
                <div class="card wrapper">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="<?= URL ?>/admin/users/">
                            <h3 class="mb-0"><i class="fas fa-users-cog"></i> System Users</h3>
                        </a>
                        <?php
                        if (isset($_GET['edit']) || isset($_GET['reset-password']))
                            echo " <button class=\"btn\" onclick='window.history.back()'><i class=\"fas fa-arrow-alt-circle-left\"></i> go back</button>";
                        ?>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET["coach-registered-successful"])) {
                            echo "<div class=\"alert alert-success\" data-disappearing><i class='fas fa-check-circle'></i> The new coach registered successful \t &nbsp; <a href=\"#\" class='close'>dismiss</a></div>";
                        }
                        if (isset($_GET["completed"])) {
                            $actionUpdate = $_GET["status"];
                            $actionCompleted = "user";
                            $alertClass = ($actionUpdate == "success") ? "success" : "danger";
                            $alertIcon = ($actionUpdate == "success") ? "fas fa-check-circle" : "fas fa-sad-cry";
                            $message = ($actionUpdate == "success") ? "the $actionCompleted was updated successful " : "there was an error while updating the $actionCompleted";

                            echo "<div class=\"alert alert-$alertClass\" data-disappearing><i class='$alertIcon'></i> $message <a href=\"#\" class='close'>dismiss</a></div>";
                        }
                        ?>
                        <div class="my-4">
                            <?php
                            try {
                                if (isset($_GET["edit"])) {
                                    if ($_GET["edit"] == "coach") {
                                        include "../coaches/update-coach.php";
                                    } else if ($_GET["edit"] == "admin") {
                                        include "./update-admin-form.php";
                                    }
                                } else if (isset($_GET['reset-password'])) {
                                    include "reset-user-password-form.php";
                                } else if (isset($_GET['change-status'])) {
                                    include "";
                                } else {
                                    include "./user-table.php";
                                }
                            } catch (DBError $e) {
                                echo "<div class=\"alert alert-danger\">something went wrong, the system thrown this error: " . $e->getMessage() . "</div>";
                            }
                            ?>
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