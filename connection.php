<?php

    $server="localhost";
    $user="root";
    $pass ="";
    $dbname="se";

       try
        {
          $con =new mysqli($server,$user,$pass,$dbname);
          if($con->connect_error)
              throw new Exception("Can not connect ," . $con->connect_error);
        }

        catch(Exception $e)
        {
            die($e->getMessage());
        }



