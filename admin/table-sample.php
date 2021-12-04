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
    <title>Sample page</title>
</head>

<body>
    <div id="root" class="h-100">
        <!-- top-nav -->
        <?php include "./includes/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include "./includes/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->
        <main class="main-contents">
            <div class="container">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First name</th>
                                <th>last name</th>
                                <th>photo</th>
                                <th>age</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Cyuzuzo</td>
                                <td>Jeacn Remy</td>
                                <td>my picture</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Cyuzuzo</td>
                                <td>Jeacn Remy</td>
                                <td>my picture</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Cyuzuzo</td>
                                <td>Jeacn Remy</td>
                                <td>my picture</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Cyuzuzo</td>
                                <td>Jeacn Remy</td>
                                <td>my picture</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Cyuzuzo</td>
                                <td>Jeacn Remy</td>
                                <td>my picture</td>
                                <td>22</td>
                            </tr>
                        </tbody>
                    </table>
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