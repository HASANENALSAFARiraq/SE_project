<?php 
    session_start();
    require 'connection.php';
    if(isset($_SESSION['check']))
    {
        try 
        {
            ///////////getting the name of the picture and delete it////////

            $stmt = $con->prepare("select pic from items where id = ?");
            if($con->error != null)
                throw new Exception($con->error);

            $stmt->bind_param("i",$_GET['id']);
            if($stmt->error != null)
                throw new Exception($stmt->error);

            $stmt->execute();
            if($stmt->error != null)
                throw new Exception($stmt->error);

            $result = $stmt->get_result();
            if($stmt->error != null)
                throw new Exception($stmt->error);

            $pic_name= $result->fetch_row();  
            
            if(@unlink($pic_name[0]))
            {
            ///////////deleting the actual record from the database////////
                 $stmt = $con->prepare("delete from items where id = ?");
                    if($con->error != null)
                        throw new Exception($con->error);

                $stmt->bind_param("i",$_GET['id']);
                    if($stmt->error != null)
                        throw new Exception($stmt->error);
                    
                $stmt->execute();
                    if($stmt->error != null)
                        throw new Exception($stmt->error);

                $result=$con->query("select * from items");
                if($con->error != null)
                {
                    throw new Exeception($con->error);
                }

            /////// returning the table after deletion 
                echo "<tr>";
                    echo "<th>Item Picture</th>";
                    echo "<th>Item ID</th>";
                    echo "<th>Item Name</th>";
                    echo "<th>Item Description</th>";
                    echo "<th>Item Price</th>";
                    
                echo "</tr>";

                while($row=$result->fetch_row())
                {
                    echo "<tr style='height:400px'>";
                        echo "<td style=\"background-image:url($row[4]) \" class=\"image_cell\"><button onclick='delete_confirm($row[0])'>Delete</button> <button>Edit</button></td>";
                        echo "<td> $row[0] </td>";
                        echo "<td> $row[1] </td>";
                        echo "<td> $row[2] </td>";
                        echo "<td> $row[3] </td>";
                        
                    echo "</tr>";
                }

            }
            else
            {
                echo "0";//// if the picture could not be deleted , send 0 to front end and check it there
            }


        }
        catch(Exception $e)
        {
            echo"0 ". $e->getmessage();///0 for error handling in the front end
        }

    }
    else
    {
        echo "<script> alert('You are not logged in, Please log in');</script>";
        echo "<script>window.location.replace('home.php'); </script>";
    }