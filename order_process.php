<?php

    require 'connection.php';

    $stmt = $con->prepare("insert into orders (name,phone,addr,item_id) values(?,?,?,?)");

    $item_id=$_POST['id'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $addr=$_POST['address'];

    if($_POST['name']!=NULL && $_POST['phone']!=NULL && $_POST['address']!=NULL)
    {   
        try 
        {
            $stmt->bind_param("sssi",$name,$phone,$addr,$item_id);
            if($con->error)
                throw new Exception($con->error);

            $stmt->execute();
            if($con->error)
                throw new Exception($con->error);

            echo "<script>alert('Order Successfully done'); window.location.replace('home.php');</script>";

            die ();
            
        }
        catch(Exception $e)
        {
            echo "<script>alert($e->getMessage()); window.location.replace('home.php');</script>";
            die ();
        }
    }
    else
    {
        echo "<script>alert('Please Enter valid information'); window.location.replace('home.php');</script>";
        die ();
    }

?>