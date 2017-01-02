<?php

function loggedin(){
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ){
        return false;
    }else{
        return true;
    }
}

?>
