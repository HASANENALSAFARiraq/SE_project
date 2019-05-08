<?php
    session_start();
    if(isset($_SESSION['check']))
    {
        session_destroy();
        setcookie("PHPSESSID","123456",time()-60,"/");
    }
    header("Location:Home.php");

?>