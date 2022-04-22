<?php
include "../includes/head.php";

?>
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
                        $user = new User();
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
<script src="<?= URL ?>/res/js/admin-sidebar.js"></script>
<script src="<?= BOOTSTRAP_JS ?>"></script>

<script>
    const disappearingAlert = document.querySelectorAll("[data-disappearing] .close")
    if (disappearingAlert) {
        disappearingAlert.forEach(el => {
            el.onclick = (e) => {
                e.preventDefault()
                el.parentElement.remove()
            }
        })

    }
</script>

</body>

</html>