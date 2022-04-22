<?php


/**
 * Define the root folder
 */
$root = __DIR__ . "/";

define('ROOT', $root . "/", true);

// include the auth class
require_once $root . "authorization.php";

require_once $root . "admin/backend/db_operations/db_basic_functions.php";
require_once $root . "admin/backend/db_operations/classUser.php";
require_once $root . "admin/backend/db_operations/classAdmin.php";
require_once $root . "admin/backend/db_operations/classBeneficiary.php";
require_once $root . "admin/backend/db_operations/classCoach.php";
require_once $root . "admin/backend/db_operations/classLoans.php";
require_once $root . "admin/backend/db_operations/classSavings.php";
require_once $root . "admin/backend/db_operations/classZone.php";
require_once $root . "admin/backend/db_operations/classVsla.php";
require_once $root . "admin/DBError.php";
require_once $root . "admin/backend/db_operations/BeneficiaryFinancialInformation.php";
