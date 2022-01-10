<?php

/**
 * @class Beneficiary
 * a code container for every activities related to beneficiarie's data 
 */
class Beneficiary
{
    /** first name */
    private $fname;

    /** Last name plus middle name */
    private $lname;

    /** Telephone number with the country code excluding the plus sign */
    private $tel_number;

    /** profile picture */
    private $image_name;
    private $image_tmp;
    private $image_upload_path;

    public function set_beneficiary_data()
    {
    }

    public function register_beneficiary()
    {
    }
}
