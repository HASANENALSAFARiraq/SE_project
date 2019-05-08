<?php 
    require 'connection.php';

    for($i=0;$i<1000 ; $i++)
    {
        try
        {
        $name="test_customer$i";
        $phone="009611234$i";
        $addr="test_city$i/test_neighborhood$i/test_house$i";
        $item_id=$i+10;

        $con->query("insert into orders (name,phone,addr,item_id) values('$name','$phone','$addr',$item_id)");
        if($con->error !=null)
            throw new Exception($con->error); 
        }
        catch(Exception $e)
        {
            echo $e->getmessage();
        }
    }



