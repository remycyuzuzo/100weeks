
    <?php
    // input: GET --beneficiary_id 
    // output: JSON Beneficiary info, status

    try {
        if (!isset($_GET['beneficiary_id'])) {
            throw new Exception("Invalid request");
        }

        require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/dependencies.php";
        require_once ROOT . "admin/backend/db_operations/classBeneficiary.php";
        require_once ROOT . "admin/backend/db_operations/classVsla.php";
        require_once ROOT . "admin/backend/db_operations/BeneficiaryFinancialInformation.php";
        require_once DB_CONNECT;

        $response = array();

        $beneficiary_id = $conn->real_escape_string($_GET['beneficiary_id']);

        $beneficiary = new Beneficiary($conn);

        if ($beneficiary->doesBeneficiaryExists($beneficiary_id) === false) {
            throw new Exception("This person does not exists in our systems");
        }

        $res = $beneficiary->getSingleBeneficiary($beneficiary_id);
        if ($res === null) {
            throw new Exception("error in getting the beneficiary information");
        }

        $paymentInfo = new PaymentInfo();
        if ($paymentInfo->hasActiveLoan($beneficiary_id)) {
            throw new Exception("The beneficiary is not eligible for the loan");
        }

        $row = $res;
        $beneficiary_name = "$row[fname] $row[lname]";

        // get VSLA name 
        $vsla = new VSLA($conn);

        $beneficiary_VSLA = $vsla->getSingleVSLAInfo($row["VSLA_id"]);

        $response = array(
            "result" => true,
            "beneficiaryName" => $beneficiary_name,
            "beneficiaryVSLA" => $beneficiary_VSLA["VSLA_name"]
        );

        echo json_encode($response);
    } catch (Exception $e) {
        $response = array("result" => false, "message" => $e->getMessage());
        echo json_encode($response);
    }
