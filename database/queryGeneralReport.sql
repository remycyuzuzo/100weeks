SELECT
                vsla_zones.vsla_zone_id AS vsla_parish_id,
                vsla_zones.vsla_zone_name AS vsla_zone_name,
                SUM(saving_records.amount) AS total_zone_savings_amount,
                COUNT(vsla_groups.VSLA_id) AS number_of_vsla,
                COUNT(beneficiaries.beneficiary_id_card) AS ben_number,
                SUM(loan_information.loan_amount) AS loan_amount,
                COUNT(loan_information.loan_id) AS number_of_loans,
                SUM(social_funds_records.amount) AS total_social_funds_amount
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
                JOIN vsla_groups ON(
                        `vsla_groups`.`VSLA_id` = `beneficiaries`.`vsla_id`
                    )
                INNER JOIN vsla_zones ON(
                        `vsla_zones`.`vsla_zone_id` = `vsla_groups`.`vsla_zone_id`
                    )
                WHERE
                    vsla_groups.vsla_zone_id = 3