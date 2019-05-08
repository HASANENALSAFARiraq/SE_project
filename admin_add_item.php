<?php 
    session_start() 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>

    <style>
        form
        {
            width: 60%;
            height: 300px;
            background-color: darkgrey;
            margin-top: 100px;
            margin-left: 300px;
        }
        form input[type="text"]
        {
            width: 80%;
            height: 10%;
            padding: 1px;
            margin-left: 10%;
            margin-top: 1%;
        }
        form button
        {
            width: 40%;
            height: 10%;
            padding: 1px;
            margin-left: 30%;
            margin-top: 1%;
            display: block;
        }
    
    </style>
    <script>
        function add()
        {
            document.getElementById("file_button").click();
        }
    </script>
    
</head>
<body>
    <?php 
        if(isset($_SESSION['check']))
        {
            echo "<form method='post' action='add_item_process.php' enctype='multipart/form-data'>";
            echo "<input type='text' name='name' placeholder='Item Name'>";
            echo "<input type='text' name='desc' placeholder='Item Description'>";
            echo "<input type='text' name='price' placeholder='Item Price'>";
            echo "<input type='file' id='file_button' name='pic' accept='image/png , image/jpeg' style='display:none'>";///hidden due to its ugly look !
            echo "<button type='button' id='add_button' onclick='add()'> Add Photo</button>";
            echo "<button type='submit'> Add </button>";
           // echo "<input type='submit' value='Add'>";
            echo "</form>";
        }
        else
        {
            echo "<script> alert('You are not logged in, Please log in');</script>";
            echo "<script>window.location.replace('home.php'); </script>";
        }

    ?>
    
</body>
</html>