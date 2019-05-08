<?php
    session_start();
?>
<!DOCTYPE html>
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
            table#items_table
            {
                border-style:solid;
                border-width:1px;
                width: 90%;
                margin-left:4%;
            }
            table#items_table th
            {
                border-style:solid;
                background-color:#555555;
                font-size:large;
                padding:5px;
                text-align:center;
                width:15%;;
            }
            table#items_table td
            {
                background-color:#999999;
                padding:5px;
                font-size:large;
                text-align:center;
                width:auto;
            }
            table#items_table td.image_cell
            {
                width:40%;
                background-position: center;
                background-repeat: no-repeat; 
                background-size: cover;
                padding:1px;
            }
            table#items_table td.image_cell button
            {
                margin-top:40%;
                border-style:none;
                width:30%;
                height:40px;
                font-size:large;
                font-weight:bold;
                background-color:white;
                border-radius:5px;

            }

        </style>
        <script src="ajax_functions.js"> </script>
        <script>

                function search(search_box_value)
                {
                   // window.location.href="admin_items_search.php?name="+search_box_value;
                    
                }
                function delete_confirm(id)
                {
                    if (window.confirm("Are you sure you want to DELETE this item ?"))
                    {
                        get_request("admin_item_delete.php?id="+id,(xhr)=>{

                                                                                if(xhr.responseText[0]=="0")
                                                                                    alert("problem in the server, the item could not be deleted");
                                                                                else
                                                                                     document.getElementById("items_table").innerHTML=xhr.responseText;
                                                                           });
                    }
                }

        </script>
    </head>

    <body>
        <div id="error"> </div>

            <?php 
                if(isset($_SESSION['check']))
                {
                    echo "<div id='menu_container'>";
                        echo"<div id='buttons_container'>";
                            echo "<button onclick=\"window.location.href='admin_add_item.php'\"> Add item </button>";
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
                        $result=$con->query("select * from items");
                        if($con->error != null)
                        {
                            throw new Exeception($con->error);
                        }

                        echo "<table id='items_table'>";

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

                        echo "</table>";
                        

                    }
                    catch(Exeception $e)
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
    </body>
</html>