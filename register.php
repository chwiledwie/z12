<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chwile Dwie - iCloud</title>
        
        <link href="css/style.css" rel="stylesheet">
        
    </head>
    <body>
        
        
      <!— Główny nagłówek strony -->
<header role=”banner”>
<!—Grupa nagłówków, użcie hgroup -->
   <!-- Header -->
    
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in"></div>
                <div class="intro-heading"></div>
           
            </div>
        </div>
    </header>
      <?php
include 'functions.php';
    if(!loggedin()){
        ?>
<!—Rozpoczynamy menu, przy użyciu nav -->
   <nav id="menu" role="navigation">
       <ul class="w3-navbar">
         
      
           <li><a href="index.php#kom">iCloud</a></li>
           <li><a href="logout.php#kom">Wyloguj</a></li>
           <li><a href="dysk.php#kom">Dysk</a></li>
           
          
        
   </nav>
    <?php
    
    }else{
?>
 <nav id="menu" role="navigation">
       <ul class="w3-navbar">
         
           <li><a href="index.php#kom">iCloud</a></li>
           <li><a href="login.php#kom">Zaloguj</a></li>
           <li><a href="register.php#kom">Zarejestruj</a></li>
           
          
        
   </nav>
<?php 
    }
?>

<section id="kom" style="min-height: 600px;">
<form method="post" action="">
           <div class="form-group">
               
               <label class="control-label" for="login">Login:</label>
               <input class="form-control" maxlength="32" type="text" name="login" id="login" />
   </div>
           
           
           <div class="form-group">
               <label class="control-label" for="pass">Hasło:</label>
               <input class="form-control" maxlength="32" type="password" name="pass" id="pass" />
           </div>
           
           <div class="form-group">
               <label class="control-label" for="pass_again">Hasło (ponownie):</label>
               <input class="form-control"maxlength="32" type="password" name="pass_v" id="pass_again" />
           </div>
           
           
           
           
          
           
           <div class="form-group" >  
               <input type="hidden" name="send" value="1" />
               <input type="submit" class="btn-success" value="Zarejestruj" />
  </div>
 
       </form>   
<br>

</section>

<footer class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Chwile Dwie 2016</span>
                </div>
                <div class="col-md-4">
                    <p>Goście: 
                        <?php include("licznik_wejsc.php"); ?>
                            </p>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </footer>


</body>
</html>






<?php
require 'confdb.php'; // Dołącz plik konfiguracyjny i połączenie z bazą
require_once 'user.class2.php';

/**
 * Sprawdź czy formularz został wysłany
 */
if ($_POST['send'] == 1) {
    // Zabezpiecz dane z formularza przed kodem HTML i ewentualnymi atakami SQL Injection
    $login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
    $pass = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
    $pass_v = mysql_real_escape_string(htmlspecialchars($_POST['pass_v']));
    

    /**
     * Sprawdź czy podany przez użytkownika email lub login już istnieje
     */
    $existsLogin = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE login='$login' LIMIT 1"));
    

    $errors = ''; // Zmienna przechowująca listę błędów które wystąpiły


    // Sprawdź, czy nie wystąpiły błędy
    if (!$login || !$pass || !$pass_v) $errors .= '- Musisz wypełnić wszystkie pola<br />';
    if ($existsLogin[0] >= 1) $errors .= '- Ten login jest zajęty<br />';
    
    if ($pass != $pass_v)  $errors .= '- Hasła się nie zgadzają<br />';

    /**
     * Jeśli wystąpiły jakieś błędy, to je pokaż
     */
    if ($errors != '') {
        echo '<p class="error">Rejestracja nie powiodła się, popraw następujące błędy:<br />'.$errors.'</p>';
    }

    /**
     * Jeśli nie ma żadnych błędów - kontynuuj rejestrację
     */
    else {

        // Posól i zasahuj hasło
       // $pass = user::passSalter($pass);

        // Zapisz dane do bazy
        mysql_query("INSERT INTO users (login,password) VALUES('$login','$pass');") or die ('<p class="error">Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.</p>');
       
        // connect and login to FTP server
$ftp_server = "serwer1638898.home.pl";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login_result = ftp_login($ftp_conn, "chwiledwie@chwiledwie.pl", "Discovery76");

$dir = 'public_html/ChwileDwie/z12/clouds/'.$login.'/';

// try to create directory $dir
if (ftp_mkdir($ftp_conn, $dir))
  {
  echo "Successfully created $dir";
  }
else
  {
  echo "Error while creating $dir";
  }

// close connection
ftp_close($ftp_conn);
        
        
        
        echo '<script>';
echo 'var strona="registerok";';
echo 'self.location.href=strona+".php";';
echo '</script>';
    }
}

?>









