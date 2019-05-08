<?php 
        session_start();
        if(isset($_SESSION['check']))
        {
            if($_POST['name']!=null & $_POST['price']!=null )///checking for information
            {
                if($_FILES['pic']['error']==0)///checking for picture
                {
                    $image_name="pic/".uniqid("",true).$_FILES['pic']['name'];///full path
                    $image_tmp_name=$_FILES['pic']['tmp_name'];

                    if(!move_uploaded_file($image_tmp_name,$image_name))
                    {
                        echo "<script> alert('we are sorry,error in the server , cannot upload image');</script>";
                        echo "<script>window.location.replace('admin_add_item.php'); </script>";
                        die();
                    }
                    if($_POST['desc']!=null)
                        $_POST['desc']="No description";
                    
                    require 'connection.php';

                    try
                    {
                        $stmt=$con->prepare("insert into items (name,des,price,pic) values(?,?,?,?)");
                        if($con->error!=null)
                            throw new Exception($con->error);
                        
                        $stmt->bind_param("ssis",$_POST['name'],$_POST['desc'],$_POST['price'],$image_name);
                        if($stmt->error!=null)
                            throw new Exception($stmt->error); 

                        $stmt->execute();
                        if($stmt->error!=null)
                             throw new Exception($stmt->error);
                        
                         echo "<script> alert('Item added');</script>";
                        echo "<script>window.location.replace('admin_items.php'); </script>";
                        
                    }
                    catch(Exception $e)
                    {
                        echo $e->getmessage();
                    }
                    
                    


                    



                }
                else
                {
                    echo "<script> alert('please select an image and try again');</script>";
                    echo "<script>window.location.replace('admin_add_item.php'); </script>";
                    die();
                }
            }
            else
            {
                echo "<script> alert('Name and price are mandatory');</script>";
                echo "<script>window.location.replace('admin_add_item.php'); </script>";
                die();
            }

        }
        else
        {
            echo "<script> alert('You are not logged in, Please log in');</script>";
            echo "<script>window.location.replace('home.php'); </script>";
            die();
        }
    ?>