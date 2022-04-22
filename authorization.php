<?php

class Authorize
{

    public function _construct()
    {
        $this->user = new User();
    }

    private function checkSession()
    {
        if (isset($_REQUEST["userSessionId"])) {
            $this->LOGGED_IN_USER = $_REQUEST["userSessionId"];
            return true;
        } else {
            return false;
        }
    }

    private function getLoggedInUserInfo()
    {
        $user_type = new User();
    }

    public function isLoggedIn()
    {
        return $this->isLoggedIn();
    }
}
