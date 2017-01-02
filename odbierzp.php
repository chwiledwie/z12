<?php
session_start();


     
 if (is_uploaded_file($_FILES['plikP']['tmp_name']))          
      {     
   
     $dirP="clouds/".$_SESSION['login']."/".$_SESSION['t']."/";
     
      echo 'Odebrano plik: '.$_FILES['plikP']['name'].'<br/>';      
      move_uploaded_file($_FILES['plikP']['tmp_name'],$dirP.$_SERVER['DOCUMENT_ROOT'].$_FILES['plikP']['name']);            
      echo 'Przejdź do panelu z plikami <a href="dysk.php#kom">tutaj</a>';
      }            
      else {echo 'Błąd przy przesyłaniu danych!';} 
    ?>
