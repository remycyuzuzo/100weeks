<?php
require $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
require DB_CONNECT;
require ROOT . "admin/backend/db_operations/db_basic_functions.php";

try {

    $vsla_zone_type = VSLA_ZONE_TYPE;
    $sql_vsla_zone = "SELECT vsla_zone_id, vsla_zone_name from vsla_zones 
                        where vsla_zone_type='$vsla_zone_type'";
    $res = DB::selectFromDb($sql_vsla_zone, $conn);

    // check whether returned results are valid
    if ($res === false) {
        throw new Exception("Error in fetching $vsla_zone_type data");
    } else if ($res === null) {
        throw new Exception("can't find any $vsla_zone_type");
    }

    /** @var array $response program Output*/
    $response = array();

    // loop through the VSLA Zones
    while ($row = $res->fetch_assoc()) {
        $total_savings_in_zone = 0;
        $total_social_funds_in_zone = 0;
        $total_zone_loan_amount = 0;
        $number_of_loans = 0;
        $total_zone_members = 0;
        $number_of_vsla = 0;
        $parish_name = "";
        $zone_assets_value = 0;

        $sql_savings = "
                    SELECT
                    vsla_zones.vsla_zone_id AS vsla_parish_id,
                    vsla_zones.vsla_zone_name AS vsla_zone_name,
                    SUM(saving_records.amount) AS total_zone_savings_amount,
                    COUNT(vsla_groups.VSLA_id) AS number_of_vsla,
                    COUNT(beneficiaries.beneficiary_id_card) AS ben_number,
                    SUM(loan_information.loan_amount) AS loan_amount,
                    COUNT(loan_information.loan_id) AS number_of_loans,
                    COUNT(saving_records.saving_record_id) AS number_of_savings,
                    SUM(social_funds_records.amount) AS total_social_funds_amount,
                    vsla_group_assets.asset_estimated_value AS zone_assets_value
                    FROM
                        saving_records
                    LEFT JOIN beneficiaries ON(
                            `saving_records`.`beneficiary_id` = `beneficiaries`.`beneficiary_id_card`
                        )
                    LEFT JOIN loan_information ON(
                            `loan_information`.`beneficiary_id` = `beneficiaries`.`beneficiary_id_card` AND `loan_information`.`loan_status` = 'active'
                        )
                    LEFT JOIN social_funds_records ON(
                            `social_funds_records`.`beneficiary_id` = `beneficiaries`.`beneficiary_id_card`
                        )
                    LEFT JOIN vsla_groups ON(
                            `vsla_groups`.`VSLA_id` = `beneficiaries`.`vsla_id`
                        )                    
                    LEFT JOIN vsla_group_assets ON(
                            `vsla_groups`.`VSLA_id` = `vsla_group_assets`.`VSLA_id`
                        )
                    INNER JOIN vsla_zones ON(
                            `vsla_zones`.`vsla_zone_id` = `vsla_groups`.`vsla_zone_id`
                        )
                    WHERE
                        vsla_groups.vsla_zone_id = $row[vsla_zone_id]
                ";

        $res1 = DB::selectFromDb($sql_savings, $conn);

        // loop though different tables related to the same VSLA
        if ($res1 === null) throw new Exception("Empty");
        if ($res1 === false) throw new Exception("Error: " . $conn->error);
        while ($row3 = $res1->fetch_assoc()) {
            $parish_name = $row3["vsla_zone_name"];
            $total_savings_in_zone += $row3["total_zone_savings_amount"];
            $total_social_funds_in_zone += $row3["total_social_funds_amount"];
            $number_of_vsla += $row3["number_of_vsla"];
            $total_zone_members += $row3["ben_number"];
            $total_zone_loan_amount += $row3["loan_amount"];
            $number_of_loans = $row3["number_of_loans"];
            $number_of_savings = $row3["number_of_savings"];
            $parish_id = $row3["vsla_parish_id"];
            $zone_assets_value +=  $row3["zone_assets_value"];
        }

        $info_array = array(
            "parishID" => $parish_id,
            "parishName" => $parish_name,
            "totalSavings" => $total_savings_in_zone,
            "totalSocialFunds" => $total_social_funds_in_zone,
            "numberOfVSLAs" => $number_of_vsla,
            "totalMembersInZone" => $total_zone_members,
            "totalLoanAmount" => $total_zone_loan_amount,
            "numberOfLoans" => $number_of_loans,
            "numberOfSavings" => $number_of_savings,
            "valueOfVSLAAssets" => $zone_assets_value
        );
        array_push($response, $info_array);
    }

    $response = array("result" => true, "parishes" => $response);

    // output in JSON format
    echo json_encode($response);

    // if (isset($_GET["lifetime_report"])) {
    //     #
    // } elseif (isset($_GET["monthly_report"])) {
    //     #
    // } elseif (isset($_GET["current_month_report"])) {
    //     # code...
    // } else {
    //     throw new Exception("incomplete request parameters");
    // }
} catch (Exception $e) {
    $response = array("result" => false, "message" => $e->getMessage() . ", on file: '" . __FILE__ . "'" . ", on line " . $e->getLine());
    echo json_encode($response);
} catch (Error $e) {
    $response = array("result" => false, "message" => $e->getMessage() . ", on file: '" . __FILE__ . "'" . ", on line " . $e->getLine());
    echo json_encode($response);
}
