<?php
try {
    if (!isset($_GET["reset-password"])) {
        echo "<script>window.location=\"/admin/users/\"</script>";
    }

    if (!isset($_GET["user_id"])) {
        throw new DBError("your request lack important parameters");
    }

    require DB_CONNECT;

    $user_id = $conn->real_escape_string($_GET["user_id"]);
    $user_type = $conn->real_escape_string($_GET["reset-password"]);
    if (empty($user_id))
        throw new DBError("Invalid parameter");

    $user = new User();

    $user_info = $user->getSingleUserDetails($user_id, $user_type);
    if ($user_info === NULL) {
        throw new DBError("This user is not registered in our systems");
    }
?>
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="title">
                <h3 class="text-center">Reset password</h3>
            </div>
            <div class="user-info">
                <div class="alert alert-secondary">
                    <div class="d-block">Name: <b><?= $user_info["fname"] . " " . $user_info["lname"] ?></b></div>
                    <div class="d-block">User group: <b><?= $user_info["user_type"] ?></b></div>
                </div>
            </div>
            <div class="send-reset-link mt-3 text-center">
                <h3 class="text-center mb-3">Send the reset-password link that will be delivered into the user's inbox</h3>
                <a href="#" class="btn btn-primary btn-lg"><i class="fas fa-user-lock"></i> send password-reset link</a>
            </div>
            <div class="mt-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="bg-primary" style="height: 2px; width: 2em;"></div>
                    <div class="px-2">Or</div>
                    <div class="bg-primary" style="height: 2px; width: 2em;"></div>
                </div>
            </div>
            <div class="card border-0 mt-3">
                <div class="message py-3 d-none">
                    <span class="text-danger">error message here</span>
                </div>
                <div class="mb-2">
                    <h3 class="text-center">Directly Reset the user's password here</h3>
                </div>
                <form action="submit_password_reset.php" method="post" data-form>
                    <div data-validate></div>
                    <div class="form-group mb-2">
                        <input type="password" name="password" placeholder="enter the new password" id="password" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <input type="password" name="password-retype" placeholder="re-enter the new password" id="retype-password" class="form-control">
                    </div>
                    <div class="form-group button-box">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-user-lock"></i> change password</button>
                    </div>
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <input type="hidden" name="user_type" value="<?= $user_type ?>">
                </form>
            </div>
        </div>
    </div>
    <script src="./js/password-reset.js" type="module"></script>
<?php
} catch (DBError $e) {
    echo "<div class=\"alert alert-warning\">" . $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ") </div>";
} catch (Exception $e) {
    echo "<div class=\"alert alert-warning\">" . $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")</div>";
} catch (Error $e) {
    echo "<div class=\"alert alert-warning\">" . $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")</div>";
} catch (Exception $e) {
    echo "<div class=\"alert alert-warning\">" . $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")</div>";
} catch (TypeError $e) {
    echo "<div class=\"alert alert-warning\">" . $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")</div>";
} catch (ParseError $e) {
    echo "<div class=\"alert alert-warning\">" . $e->getMessage() . " on line: " . $e->getLine() . "(" . $e->getFile() . ")</div>";
}

?>