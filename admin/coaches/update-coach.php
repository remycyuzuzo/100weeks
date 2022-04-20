<?php
try {
    if (!isset($_GET["edit"])) {
        echo "<script>window.location=\"/coach/users/\"</script>";
    }

    if (!isset($_GET["user_id"])) {
        throw new DBError("your request lack important parameters");
    }

    require DB_CONNECT;

    $user_id = $conn->real_escape_string($_GET["user_id"]);
    if (empty($user_id))
        throw new DBError("Invalid parameter");

    $coach = new Coach();

    $coach_info = $coach->getSingleCoachInfo($user_id);
    if ($coach_info === NULL) {
        throw new DBError("This user is not registered in our systems");
    }

?>

    <div class="">
        <div class="form">
            <div class="text-muted">
                <i class="fas fa-question-circle"></i> you can only change personal information here
            </div>
            <hr>
            <form action="<?= URL ?>/admin/coaches/submit_coach_updates.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <input type="hidden" name="user-id" value="<?= $_GET["user_id"] ?>">
                    <h4>change the name</h4>
                    <div class="form-group col-md-6">
                        <label for="fname">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?= $coach_info["fname"] ?>" placeholder="First name" name="fname" id="fname" data-required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname">Last name</label>
                        <input type="text" class="form-control" value="<?= $coach_info["lname"] ?>" placeholder="Last name" id="lname" name="lname">
                    </div>
                </div>
                <div class="row">
                    <h4>change other information</h4>
                    <div class="form-group col-md-6">
                        <label for="idcard">ID card / Passport number</label>
                        <input type="number" class="form-control" value="<?= $coach_info["id_card_number"] ?>" placeholder="ID card number" id="idcard" name="idcard">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tel">Telephone number <span class="text-danger"></span></label>
                        <input type="tel" class="form-control" value="<?= $coach_info["tel_number"] ?>" placeholder="Telephone number" id="tel" name="tel" data-required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" value="<?= $coach_info["email"] ?>" placeholder="Email address" id="email" name="email" data-required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <fieldset class="py-2">
                        <label for="radioFemale"><input type="radio" name="gender" value="F" id="radioFemale" <?= ($coach_info["gender"] == "F") ? "checked" : "" ?>> Female</label>
                        <label for="radioMale" class="pl-2" style="padding-left: 10px;"><input type="radio" name="gender" id="radioMale" value="M" <?= ($coach_info["gender"] == "M") ? "checked" : "" ?>> Male</label>
                    </fieldset>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-light border" onclick="history.back()"><i class="fas fa-arrow-left"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> save changes</button>
                </div>
                <input type="hidden" name="update_coach_info">
            </form>
            <div class="my-2" data-result></div>
        </div>
    </div>

<?php
} catch (DBError $e) {
    echo "<div class=\"alert alert-warning\">" . $e->getMessage() . "</div>";
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

<script src="<?= URL ?>/admin/coaches/js/validate-coach-updates-fields.js" type="module"></script>