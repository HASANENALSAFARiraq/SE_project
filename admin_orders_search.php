
            <?php 
                 session_start();
                if(isset($_SESSION['check']))
                {
                    require 'connection.php';
                    try
                    {
                        $stmt=$con->prepare("select * from orders where name like CONCAT(?,'%')");
                        if($con->error != null)
                        {
                            throw new Exception($con->error);
                        }

                        $stmt->bind_param("s",$_GET['name']);
                        if($stmt->error != null)
                        {
                            throw new Exception($con->error);
                        }
                        
                        $stmt->execute();
                        if($stmt->error != null)
                        {
                            throw new Exception($con->error);
                        }
                        $result = $stmt->get_result();

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
                    catch(Exception $e)
                    {
                        echo $e->getmessage();
                    }
                    

                }
                else
                {
                    echo "<script> alert('You are not logged in, Please log in');</script>";
                    echo "<script>window.location.replace('home.php'); </script>";
                }
            ?>