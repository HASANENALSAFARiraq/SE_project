<!DOCTYPE html>
<?php
    session_start();
?>
<html>
    <head>
        <style>
            body
            {
                background-color:#333333;
                padding-top:72px;
                margin:0px;
            }
            div#menu_container
            {
                background-color:#171717;
                position:fixed;
                top:0px;
                width:100%;
                height:70px;

            }
            div#menu_container div#buttons_container
            {
                width:20%;
                height:90%;
                margin-top:15px;
                margin-left:7px;
               // background-color:black;
            }
            div#menu_container div#buttons_container button 
            {
                height:50%;
                margin:3px;
                border-radius:5px;
            }
            div#menu_container div#search_container
            {
                margin-top:-60px;
                margin-right:30%;
                width:40%;
                height:95%;
                float:right;
            }
            div#menu_container div#search_container input[type="text"]
            {
                width:80%;
                height:40%;
                margin:3px;
                border-radius:5px;
            }
            div#menu_container div#search_container button
            {
                width:17%;
                height:50%;
                border-radius:5px;
            }
            table#orders_table
            {
                border-style:solid;
                border-width:1px;
                width: 80%;
                margin-left:7%;
            }
            table#orders_table th
            {
                border-style:solid;
                background-color:#555555;
                font-size:large;
                padding:5px;
                text-align:center;
                width:15%;;
            }
            table#orders_table td
            {
                //border-style:solid;
                background-color:#999999;
                padding:5px;
                font-size:large;
                text-align:center;
                width:auto;
            }

        </style>

        <script src="ajax_functions.js"></script>
        <script >

                function send_to_server()
                {
                    var delete_radios = document.getElementsByName("delete_radio");
                    var deliver_radios = document.getElementsByName("deliver_radio");
                    var delete_id=0;
                    var deliver_id=0;
                    
                    for(var i =0;i < delete_radios.length;i++)
                    {
                        if(delete_radios[i].checked)
                            delete_id=delete_radios[i].value;
                    }

                    for(var i =0;i < deliver_radios.length;i++)
                    {
                        if(deliver_radios[i].checked)
                            deliver_id=deliver_radios[i].value;
                    }

                    get_request("admin_main_process.php?delete="+delete_id+"&deliver="+deliver_id,(xhr)=>{
                                                                                                            if(xhr.responseText[0]=="0")
                                                                                                            {
                                                                                                                alert("error" + xhr.responseText);
                                                                                                            }
                                                                                                            else
                                                                                                            {
                                                                                                               document.getElementById("orders_table").innerHTML= xhr.responseText;
                                                                                                               
                                                                                                            }
                                                                                                            
                                                                                                          });
                }

                function search(search_box_value)
                {

                    get_request("admin_orders_search.php?name="+search_box_value,(xhr)=>{
                                                                                             document.getElementById("orders_table").innerHTML= xhr.responseText;
                                                                                        })
                    
                }
 

        </script>
    </head>

    <body>
        <div id="error"></div>
            <?php 
                if(isset($_SESSION['check']))
                {
                    echo "<div id='menu_container'>";
                        echo"<div id='buttons_container'>";
                            echo "<button onclick=\"send_to_server()\"> Commit changes </button>";
                            echo "<button onclick=\"window.location.href='admin_items.php'\"> Go to items </button>";
                            echo "<button onclick =\"window.location.replace('log_out.php') \"> Log Out </button>";
                            
                        echo"</div>";

                        echo "<div id ='search_container'>";
                                echo "<input type='text' name='search_text' placeholder='Enter Customer Name'>";
                                echo "<button onclick=\"search(document.getElementById('search_container').getElementsByTagName('input')[0].value);\"> Search </button>";
                        echo "</div>";

                        
                    echo "</div>";

                    require 'connection.php';
                    try
                    {
                        $result=$con->query("select * from orders order by(id)");
                        if($con->error != null)
                        {
                            throw new Exeception($con->error);
                        }

                        echo " <table id='orders_table'>";

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
                        echo "</table>";
                        

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
            ?>
    </body>
</html>