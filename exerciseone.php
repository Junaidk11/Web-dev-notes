<?php

$users = array(

            "fullname"=>"Junaid",
            "nationality"=>"Pakistani", 
            "currentAdd"=>"Canada",
            "age"=>23
    
            "fullname"=>"Adam",
            "nationality"=>"Indian", 
            "currentAdd"=>"USA",
            "age"=>25
            );

/*$users['fullname']="Adam";
$users['nationality']="American";
$users['currentAdd']="India";
$users['age']=25;
*/


foreach($users as $user)
{
    
    echo "$user <br>";
}

?>