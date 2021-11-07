<?php

# check whether the session/cookie is set, if not, redirect the page to the login page
if (isset($_SESSION['logged_in'])) {
    
} else {
    echo "<script>window.location='".URL."'/admin/login.php</script>";
}