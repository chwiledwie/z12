<?php
session_start();
 if (is_uploaded_file($_FILES['plik']['tmp_name']))          
      {     
     $dir="clouds/".$_SESSION['login']."/";
     
      echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';      
      move_uploaded_file($_FILES['plik']['tmp_name'],$dir.$_SERVER['DOCUMENT_ROOT'].$_FILES['plik']['name']);            
      echo 'Przejdź do panelu z plikami <a href="dysk.php#kom">tutaj</a>';
      }            
      else {echo 'Błąd przy przesyłaniu danych!';} 
    ?>
