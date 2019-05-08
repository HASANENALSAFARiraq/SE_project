<!DOCTYPE html>
<html>
    <head>
        <title>HOME</title>

        <style>
            body
            {
                margin-top:0px;
                margin-left:0px;
                margin-right:0px;
                padding-top:72px;
            }

            div#menu_container
            {
                position:fixed;
                background-color:#144111;
                height:70px;
                width:100%;
                top:0px;
            }
            div#menu_container div#login_container
            {
                width:20%;
                height:90%;
                margin:3px;
               // background-color:#128954;
                float:left;
            }
            div#menu_container div#login_container input[type="text"]
            {
                width:60%;
                margin:1px;
            }
            div#menu_container div#login_container input[type="password"]
            {
                width:60%;
                margin:1px;
            }
            div#menu_container div#login_container input[type="submit"]
            {
                position:relative;
                top:-10px;
                color:black;
                padding:2px;
                width:22%;
                margin:1px;
            }
            div#menu_container div#search_container
            {
                margin-top:15px;
                margin-right:30%;
                width:40%;
                height:95%;
                float:right;
            }
            div#menu_container div#search_container input[type="text"]
            {
                width:80%;
                height:40%;
            }
            div#menu_container div#search_container button
            {
                width:17%;
                height:50%;
            }

            div.item_container
            {
                width:70%;
                height:279px;
                border-style:solid;
                border-width:1px;
                overflow:hidden;
                margin-left:200px;
                padding:0px;
            }
            div.item_container div.pic_container
            {
               width:50%;
               float:left;
               margin:0px;
            }
            div.item_container div.pic_container img.item_pic
            {
               width:95%;
               height:80%;
               align:center;
            }

            div.item_container div.info_container
            {
                width:50%;
                float:right;
                margin:0px;
            }
            
        </style>

        <script>
                function order(item_id)
                {
                    window.location.href="order.html?id="+item_id;
                }

                function search(search_box_value)
                {
                    window.location.href="search.php?name="+search_box_value;
                }

        
        </script>


    </head>

    <body>

        <div id="menu_container">

            <div id="login_container">
                <form method="post" action="login_check.php">
                    <input type="text" name="username" placeholder="user name">
                    <input type="password" name="password" placeholder="password">
                    <input type="submit" value="LOGIN">
                </form>

            </div>

            <div id="search_container">
                <input type="text" placeholder="Enter to search">
                <button onclick="search(document.getElementById('search_container').getElementsByTagName('input')[0].value);"> search</button>  
            </div>
            

        </div>


        <?php
            require 'connection.php';
            $stmt =$con->prepare("select * from items where name = ? ");
            $stmt->bind_param("s",$name);
            $name=$_GET['name'];
            $stmt->execute();
            $result =$stmt->get_result();
        
            echo $con->error;
            

            while($row=$result->fetch_assoc())
            {
                echo "<div class='item_container'>";

                    echo "<div class='pic_container'>";
                        echo "<img src='$row[pic]' class='item_pic' ";
                    echo "</div> </div>";
                    

                    echo "<div class='info_container'>";    
                        echo "<h3 class='item_name'>name: $row[name]</h3>";
                        echo "<p class='item_desc'>$row[des]</p>";
                        echo "<p class='item_price'>Price: $row[price]</p>";
                        echo "<button onclick='order($row[id])'>Order</button>";
                    echo "</div>";

                echo "</div>";

            }

        ?>


    </body>





</html>