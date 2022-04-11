<div class="btns my-2 d-flex justify-content-between">
    <div>
        <a href="/admin/coaches/" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> new coach</a>
        <a href="<?= URL ?>/admin/admin-creation-form.php" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> new administrator</a>
    </div>
    <div class="drp d-inline-block">
        <form action="" id="form" class="form-inline" method="get">
            <div class="form-group">
                <select name="show-only" class="form-control" onchange="submit()" id="">
                    <option value="" selected><?= _("Show only") ?>:</option>
                    <option value="admin">Administrator</option>
                    <option value="coach">Coach</option>
                    <option value="">All</option>
                </select>
            </div>
        </form>
    </div>
</div>
<div data-results></div>
<div class="table-responsive">
    <?php
    try {
        $data = $user->getAllUsersDetails();
        if (isset($_GET["show-only"])) {
            if ($_GET["show-only"] == "coach")
                $data = $user->getAllUsersDetails(true, "coach");
            elseif ($_GET["show-only"] == "admin")
                $data = $user->getAllUsersDetails(true, "admin");
        }
    } catch (DBError $e) {
        echo $e->getMessage() . "<br>File: " . $e->getFile() . "<br>Line: " . $e->getLine();
    }

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
                $i = 0;
                foreach ($data as $values) {
                    echo "<tr>";
                    echo "<td>" . ++$i . "</td>";
                    echo "<td>" . $values["fname"] . " " . $values["lname"] . "</td>";
                    echo "<td>" . $values["user_type"] . "</td>";
                    echo "<td>" . $values["status"] . "</td>";
                    echo "<td>" . "" . "</td>";
                    if ($values["user_type"] === "coach") $user_id = $values["coach_id"];
                    if ($values["user_type"] === "admin") $user_id = $values["admin_id"];
                    $action = ($values["status"] === "active") ? "disable" : "enable";
                    echo "<td>
                        <a href='" . URL . "/admin/users/?edit=$values[user_type]&user_id=$user_id' class='btn btn-secondary btn-sm'><i class='fas fa-user-edit'></i> edit $values[user_type]</a>
                        <a href='" . URL . "/admin/users/?reset-password=$values[user_type]&user_id=$user_id' class='btn btn-secondary btn-sm'><i class='fas fa-key'></i> modify credentials</a>
                        <a href='#' class='btn btn-secondary btn-sm' data-disable data-action=$action data-usertype=$values[user_type] data-userid=$user_id>$action</a>
                        
                        </td>";

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

<script src="./js/disable_user.js"></script>