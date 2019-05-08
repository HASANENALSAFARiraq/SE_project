<?php 
    require 'connection.php';

    session_start();

    if(isset($_SESSION['check']))
    {

        if($_GET['deliver']!=0)
        {
            try
            {
                $stmt=$con->prepare("update orders set delivered ='Yes' where id = ?");
                
                if($con->error != null)
                    throw new Exception($con->error);

                $stmt->bind_param("s",$_GET['deliver']);
                if($stmt->error != null)
                    throw new Exception($stmt->error);

                $stmt->execute();
                if($stmt->error != null)
                    throw new Exception($stmt->error);
                
            }
            catch(exception $e)
            {
                die("0 ".$e->getmessage());
            }
        }

        if($_GET['delete']!=0)
        {
            try
            {
                $stmt=$con->prepare("delete from orders where id = ?");
                
                if($con->error != null)
                    throw new Exception($con->error);

                $stmt->bind_param("s",$_GET['delete']);
                if($stmt->error != null)
                    throw new Exception($stmt->error);

                $stmt->execute();
                if($stmt->error != null)
                    throw new Exception($stmt->error);
                
            }
            catch(exception $e)
            {
                die("0 ".$e->getmessage());
            }    
        }

        try
        {
            $result=$con->query("select * from orders order by(id)");
            if($con->error != null)
            {
                throw new Exeception($con->error);
            }


                echo "<tr>";
                    echo "<th> Order ID </th>";
                    echo "<th> Customer name </th>";
                    echo "<th> Customer Phone  </th>";
                    echo "<th> Address </th>";
                    echo "<th> Item ID </th>";
                    echo "<th> Order Date </th>";
                    echo "<th> Deliverd ? </th>";
                    echo "<th> Delivered </th>";
                    echo "<th> Delete </th>";
                echo "</tr>";

                while($row=$result->fetch_row())
                {
                    echo "<tr>";
                        echo "<td> $row[0] </td>";
                        echo "<td> $row[1] </td>";
                        echo "<td> $row[2] </td>";
                        echo "<td> $row[3] </td>";
                        echo "<td> $row[4] </td>";
                        echo "<td> $row[5] </td>";
                        echo "<td> $row[6] </td>";
                        echo "<td> <input type='radio' name='deliver_radio' value=$row[0]> </td>";
                        echo "<td> <input type='radio' name='delete_radio' value=$row[0]> </td>";
                    echo "</tr>";
                }

                 echo "<tr> <td colspan='9'>   </td></tr>";
            

        }
        catch(Exeception $e)
        {
            echo $e->getmessage();
        }

    }
    else
    {
        echo "<script> alert('You are not logged in, Please log in'); window.location.herf='home.php'; </script>";
        echo "<script>window.location.replace('home.php'); </script>";
    }
