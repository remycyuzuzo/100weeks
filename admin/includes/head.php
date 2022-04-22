<?php

require dirname(__FILE__, 2) . "/dependencies.php";
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
        <?php include __DIR__ . "/top-nav.php" ?>
        <!-- ./top-nav -->

        <!-- side-bar menu -->
        <?php include __DIR__ . "/side-bar.php"; ?>
        <!-- ./side-bar -->

        <!-- main-contents -->