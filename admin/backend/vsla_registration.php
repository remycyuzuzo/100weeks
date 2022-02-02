<?php

// check whether this is not a click-bait attack
if (isset($_REQUEST['vsla'])) {

    include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_connection.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/db_basic_functions.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/db_operations/classVsla.php";

    /** vsla given name */
    $vsla_name = isset($_POST['name']) ? $conn->real_escape_string($_POST["name"]) : "";

    /** VSLA Founding date */
    $vsla_founding_date = isset($_POST['founding_date']) ? $conn->real_escape_string($_POST["founding_date"]) : "";

    /** VSLA Founding date */
    $vsla_joining_date = isset($_POST['date_joined_program']) ? $conn->real_escape_string($_POST["date_joined_program"]) : "";

    /** VSLA Founding date */
    $meeting_frequency = isset($_POST['paying_frequency']) ? $conn->real_escape_string($_POST["paying_frequency"]) : "weekly";

    /** VSLA Founding date */
    $saving_amount = isset($_POST['saving_amount']) ? $conn->real_escape_string($_POST["saving_amount"]) : "";

    /** VSLA Founding date */
    $social_funds = isset($_POST['social_funds']) ? $conn->real_escape_string($_POST["social_funds"]) : "";

    /** Maximum loan per person */
    $maximum_loan = isset($_POST['maximum_loan']) ? $conn->real_escape_string($_POST["maximum_loan"]) : "";

    /** Loan interest */
    $loan_interest = isset($_POST['loan_interest']) ? $conn->real_escape_string($_POST["loan_interest"]) : "";

    $loan_overdue_interest_rate = isset($_POST["loan_overdue_rate"]) ? $conn->real_escape_string($_POST["loan_overdue_rate"]) : "";
    // REGISTER THE VSLA

    $data = array('VSLA_name' => $vsla_name, 'datetime_registered' => date("Y:m:d m:s:i"), "date_created" => $vsla_founding_date, "date_joined_the_organization" => $vsla_joining_date, "meetings_frequency" => 4, "amount_per_share" => $saving_amount, "social_funds_amount" => $social_funds, "maximum_loan_amount" => $maximum_loan, "default_overdue_loan_fine" => $loan_overdue_interest_rate);

    /** VSLA object */
    $vsla = new VSLA($conn);

    // initialize vsla properties
    $vsla->set_vsla_data($data);

    // register into the database
    $res = $vsla->insert_into_db();

    if ($res) {
        if (isset($_POST["return"])) {
            echo '<script>window.location="' . URL . '/admin/vsla/vsla-creation.php/?successfully-added"</script>';
        } else {
            echo '<script>window.location="' . URL . '/admin/vsla/vsla-view.php/?successfully-added"</script>';
        }
    } else {
        echo "error: " . $conn->error;
    }
}
