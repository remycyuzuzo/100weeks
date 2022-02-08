<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
require DB_CONNECT;
require_once ROOT . "admin/backend/db_operations/classLoans.php";

$loans = new Loan();

$res = $loans->getAllActiveLoans();
print_r($res);

if ($res === null) {
    echo "There are no active loans";
} elseif ($res === false) {
    echo $loans->getErrors();
} else {
    while ($row = $res->fetch_assoc()) {
        # code...
    }
}
