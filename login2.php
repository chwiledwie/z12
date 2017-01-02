<?php
session_start();

require 'confdb.php'; // Dołącz plik konfiguracyjny i połączenie z bazą

/**
 * SKRYPT LOGOWANIA
 */
require_once 'user.class2.php'; // Dołączamy rdzeń systemu użytkowników

// Zabezpiecz zmienne odebrane z formularza, przed atakami SQL Injection
$login = htmlspecialchars(mysql_real_escape_string($_POST['login']));
$pass = mysql_real_escape_string($_POST['password']);




if ($_POST['send'] == 1) {
    // Sprawdź, czy wszystkie pola zostały uzupełnione
    if (!$login or empty($login)) {
        die ('<p class="error">Wypełnij pole z loginem!</p>');
    }

    if (!$pass or empty($pass)) {
        die ('<p class="error">Wypełnij pole z hasłem!</p>');
    }

    
    
    // Sprawdź, czy użytkownik o podanym loginie i haśle isnieje w bazie danych
    $userExists = mysql_query("SELECT * FROM users WHERE login = '$login' AND password = '$pass' LIMIT 1;");
   $bla = mysql_fetch_array($userExists);

    if ($bla[0] == 0) {
        
          $myip = $_SERVER["REMOTE_ADDR"];
        
        $q = "SELECT * FROM logi WHERE IP = '$myip' AND poprawnelog = 'NIE';"; 
   $result = mysql_query($q) or die('Blad: '.mysql_error());
   $data = mysql_fetch_array($result);
   
   
        if($data){
            $proby = $data['liczbaprob']+1;
            if($proby==3){
                echo '<p>Konto zablokowane na 15 minut.</p>';
                
                
                $q = "UPDATE logi SET liczbaprob='$proby', datagodzina=NOW() WHERE IP = '$myip' AND poprawnelog = 'NIE';";
       $result = mysql_query($q)or die('Blad: '.mysql_error());
            }else{
                 $q = "UPDATE logi SET liczbaprob='$proby' WHERE IP = '$myip' AND poprawnelog = 'NIE';";
       $result = mysql_query($q)or die('Blad: '.mysql_error());
            }
        }else{
        $q = "INSERT INTO logi (idl,IP,liczbaprob,poprawnelog) VALUES ('','$myip','$proby','NIE') ;";
     $result = mysql_query($q)or die('Blad: '.mysql_error()); 
        }
        
        // Użytkownik nie istnieje w bazie
        echo '<p class="error">Użytkownik o podanym loginie i haśle nie istnieje.</p>';
    }

    else {
        // Użytkownik istnieje
        $user = user::getData($login, $pass); // Pobierz dane użytknika do tablicy i zapisz ją do zmiennej $user

        // Przypisz pobrane dane do sesji
        
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $pass;
        $_SESSION['idu'] = $bla[0];
        
        
        // check if this IP address is currently blocked 

$sql = "select liczbaprob, datagodzina from logi where IP = '" . $_SERVER["REMOTE_ADDR"] . "' AND poprawnelog='NIE';";
$rs = mysql_query($sql); 
$data = mysql_fetch_array($rs); 
 

  
 



$atime = strtotime($data['datagodzina']); 
//$time = mktime($atime[3],$atime[4],$atime[5],$atime[1],$atime[2],$atime[0]); 
$diff = (time()-$atime)/60; 

if ($data['liczbaprob']>=3) 
{ 
  if($diff<15) 
  { 
      
    echo "<p align=center><br><font color=red><b>Konto zablokowane na 15 minut.</b> <font></p>";
   
  } 
  else
  { 
       $myip = $_SERVER["REMOTE_ADDR"];
      $q = "INSERT INTO logi (idl,IP,liczbaprob,poprawnelog) VALUES ('','$myip','1','TAK') ;";
     $result = mysql_query($q)or die('Blad: '.mysql_error()); 
     
     $q = "SELECT datagodzina FROM logi WHERE IP='$myip' AND poprawnelog='NIE';";
     $result = mysql_query($q);
     $shitA = mysql_fetch_array($result);  //robi pętlę i przypisuje wszystkie dane do zmiennej
    
     
      echo '<p>Ostatnie błędne logowanie: '.$shitA['datagodzina'].'</p>';
      
    $qq=("update logi set liczbaprob=0 where IP = '" . $_SERVER["REMOTE_ADDR"] . "' AND poprawnelog='NIE';");
    $result = mysql_query($qq)or die('Blad: '.mysql_error());
    
     echo '<p class="success">Zostałeś zalogowany. Przejdź do panelu administratora <a href="dysk.php">tutaj</a></p>';
        echo '<p>Wyloguj: <a href="logout.php">tutaj</a></p>';
    
     
  } 
}else if($data['liczbaprob']<3){
    
    $myip = $_SERVER["REMOTE_ADDR"];
      $q = "INSERT INTO logi (idl,IP,liczbaprob,poprawnelog) VALUES ('','$myip','1','TAK') ;";
     $result = mysql_query($q)or die('Blad: '.mysql_error()); 
     
     $q = "SELECT datagodzina FROM logi WHERE IP='$myip' AND poprawnelog='NIE';";
     $result = mysql_query($q);
     $shitA = mysql_fetch_array($result);  //robi pętlę i przypisuje wszystkie dane do zmiennej
    
     
      echo '<p>Ostatnie błędne logowanie: '.$shitA['datagodzina'].'</p>';
    
    $qq=("update logi set liczbaprob=0 where IP = '" . $_SERVER["REMOTE_ADDR"] . "' AND poprawnelog='NIE';");
    $result = mysql_query($qq)or die('Blad: '.mysql_error());
    
    echo '<p class="success">Zostałeś zalogowany. Przejdź do panelu administratora <a href="dysk.php">tutaj</a></p>';
        echo '<p>Wyloguj: <a href="logout.php">tutaj</a></p>';
} 



     
       
       
       
    }
}else {
 
?>

<?php

}


?>
