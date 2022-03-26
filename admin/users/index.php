<?php
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
            <div class="container">
                <div class="card wrapper">
                    <div class="card-header">
                        <h3><i class="fas fa-users-cog"></i> System Users</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET["coach-registered-successful"])) {
                            echo "<div class=\"alert alert-success\" data-disappearing><i class='fas fa-check-circle'></i> The new coach registered successful \t &nbsp; <a href=\"#\" class='close'>dismiss</a></div>";
                        }

                        ?>
                        <div class="my-4">
                            <div class="table-responsive">
                                <?php
                                $data = $user->getAllUsersDetails();
                                if ($data != null) {
                                ?>
                                    <table class="table table-hover">
                                        <thead>
                                            <th>#</th>
                                            <th>name</th>
                                            <th>role</th>
                                            <th>status</th>
                                            <th>last sign-in</th>
                                            <th>actions</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($data as $values) {
                                                $user_id = $values["user_id"];
                                                $user_name = $values["fname"] . " " . $values["lname"];
                                                $user_type = $values["user_type"];
                                                $user_status = $values["user_status"];
                                                $user_last_sign_in = $values["user_last_sign_in"];
                                                $user_last_sign_in = date("d-m-Y H:i:s", strtotime($user_last_sign_in));
                                                $user_status = $user_status == 1 ? "active" : "inactive";
                                                $user_role = $user_type == "admin" ? "admin" : "coach";
                                                echo "<tr>";
                                                echo "<td>" . $user_id . "</td>";
                                                echo "<td>" . $user_name . "</td>";
                                                echo "<td>" . $user_role . "</td>";
                                                echo "<td>" . $user_status . "</td>";
                                                echo "<td>" . $user_last_sign_in . "</td>";
                                                echo "<td>";
                                                echo "<a href=\"#\" class=\"btn btn-primary btn-sm\"><i class=\"fas fa-edit\"></i></a>";
                                                echo "<a href=\"#\" class=\"btn btn-danger btn-sm\"><i class=\"fas fa-trash-alt\"></i></a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else {
                                ?>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> there is no user registered
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
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