<?php
session_start();
$cookie_name = "user";
$cookie_value = $_SESSION['login'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

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

    if ( isset($_COOKIE[$cookie_name]) ){
        ?>
<!—Rozpoczynamy menu, przy użyciu nav -->
   <nav id="menu" role="navigation">
       <ul class="w3-navbar">
         
      
           <li><a href="index.php#kom">iCloud</a></li>
           <li><a href="logout.php#kom">Wyloguj</a></li>
           <li><a href="dysk.php#kom">Dysk</a></li>
           
           
            <li class="dropdown"><a class="tab1 dropbtn"><?php echo $_COOKIE[$cookie_name];?></a>
                <ul>
                    <div class="dropdown-content">
                        <p class="pasek3">Zalogowany</p>
                    </div>
                </ul>
            </li>
          
        
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

     <?php


if ( isset($_COOKIE[$cookie_name]) )
{
    


//echo '<br/><br/><br/>zalogowany jako:'.$_COOKIE[$cookie_name];


?>
    <p class="etykieta1">Wgraj plik:</p>
    <form class="pasek4" action="odbierz.php" method="POST" ENCTYPE="multipart/form-data">             
        <input class="in" type="file" name="plik"/>  
        <input class="in" type="submit" value="Wyślij plik"/> 
 </form>   
     
    <p class="etykieta1">Utwórz katalog:</p>
    <form class="pasek4" action="createF.php" method="POST" ENCTYPE="multipart/form-data">             
        <input class="in" type="text" placeholder="nazwa katalogu" name="katalog"/>  
        <input class="in" type="submit" value="Utwórz katalog"/> 
 </form>   
      
    
    <p class="pasek2"></p>
    <p class="pasek1"> Twój Dysk:</p>
    
<br/>
<?php

if ( !isset( $_GET['step'] ) )
{

$ftp_server = "serwer1638898.home.pl";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$ftp_username = "chwiledwie@chwiledwie.pl";
$ftp_userpass = "Discovery76";
$login_result2 = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

// get file list of current directory
$log = $_SESSION['login'];


$dir ='clouds/'.$log.'/';

function is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL; 
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      return FALSE;
    }
  }
  return TRUE;
}
$i=0;

?>                
                <table class="tabelkaG">
<?php
    echo "<tr>";
$a = ftp_nlist($ftp_conn, "./public_html/ChwileDwie/z12/clouds/".$log."/");
foreach($a as $value){
    
             if ($i % 3 == 0 && $i != 0) {

        echo '</tr><tr>';
    
    }?>
<?php echo "<td>";
if(is_dir($dir.'/'.  basename($value))){
    if(is_dir_empty($dir.'/'.basename($value))){
         echo'<a href="podkatalog.php?t='.basename($value).'#kom"><img src="img/folder.png"/></a>';
    }else{
        echo'<a href="podkatalog.php?t='.basename($value).'#kom"><img src="img/folder full.png"/></a>';
    }
    
    
}else{
   echo'<a href="podkatalog.php?t='.basename($value).'#kom"><img src="img/file.png"/></a>'; 
}
?>

<?php echo "<center>".  substr(basename($value),0,10). "</center>"; ?>
<?php echo "</td>";

$i++;
    }

echo "</tr>";
?>
</table>

<p class="pasek2"></p>

<?php
// close connection
ftp_close($ftp_conn);


}
?>

<?php
}else {
    ?>

        <div class="mmm">
            <img src="img/img1.jpg"/>
        </div>
<div>
   
    <p class="witaj">Zapraszam do korzystania z usługi iCloud - chmury na pliki. Aby korzystać należy się zarejestrować, a następnie zalogować.</p>
    <p class="contentW">U nas pliki są zawsze bezpieczne.</p>
    
        
</div>
<div>
    <img class="pic" src="img/img2.jpg"/>
</div>
<?php
    // Teskt witający
}
?>
<?php 
include 'confdb.php';

$utf8 = ('SET NAMES utf8');
$wynik = mysql_query($utf8) or die(mysql_error()); 



if ( isset($_SESSION['log']) )
{    
// pliki

}
?>
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
