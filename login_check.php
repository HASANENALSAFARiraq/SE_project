<?php
    require 'connection.php';


    try
    {
        $stmt = $con->prepare("select count(*) from admins where username = ? and password= ?");
        if($con->error !=null)
        {
            throw new Exception($con->error);
        }

        $stmt->bind_param("ss",$username,$password);
        $username=$_POST['username'];
        $password=$_POST['password'];
        $stmt->execute();
        if($stmt->error !=null)
        {
            throw new Exception($stmt->error); 
        }

        $result = $stmt->get_result();
        $count_result= $result->fetch_row();

        if($count_result[0]===0)
        {
            echo "<script> alert('wrong information, please check your information'); window.location.herf='home.php'; </script>";
            echo "<script>window.location.replace('home.php'); </script>";
            die();    
        }
        if($count_result[0]===1)
        {
            session_start();
            $_SESSION['check']="true";
            header("Location: admin_main.php");
            die();
        }


    }
    catch(Exception $e) 
    {
        echo $e->getMessage();
        die();
    }





?>