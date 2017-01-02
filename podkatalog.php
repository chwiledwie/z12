<?php
session_start();
$cookie_name = "user";
$cookie_value = $_SESSION['login'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

$_SESSION['t'] = $_GET['t'];
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
            <li><a class="tab1"><?php echo $_COOKIE[$cookie_name];?></a></li>
          
        
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

?>
    <p class="etykieta1">Wgraj plik:</p>
    <form class="pasek4" action="odbierzp.php" method="POST" ENCTYPE="multipart/form-data">             
        <input class="in" type="file" name="plikP"/>  
        <input class="in" type="submit" value="Wyślij plik"/> 
 </form>   
    <br/>   
    
<?php    
$where = $_SESSION['t'];
?>
<p class="pasek2"></p>
    <p class="pasek5"> Jesteś w katalogu: <?php echo $where;?></p>


    <br/>
<?php



$ftp_server = "serwer1638898.home.pl";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$ftp_username = "chwiledwie@chwiledwie.pl";
$ftp_userpass = "Discovery76";
$login_result2 = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);


// get file list of current directory
$log = $_SESSION['login'];


$dir ="/public_html/ChwileDwie/z12/clouds/".$log."/".$_SESSION['t']."";
echo '<a href="dysk.php#kom"><img src="img/back.png"/></a> <BR>';

$i=0;

?>                
                <table class="tabelkaG">
<?php
    echo "<tr>";
$b = ftp_nlist($ftp_conn, "./public_html/ChwileDwie/z12/clouds/".$log."/".$_SESSION['t']);
foreach($b as $valueP){
    
             if ($i % 3 == 0 && $i != 0) {

        echo '</tr><tr>';
    
    }?>
<?php echo "<td>";
echo '<a href="ftp://'.$ftp_username.'@'.$ftp_server.$dir.'/'.basename($valueP).'"><img src="img/file.png"/></a>';

?>

<?php echo "<center>".  substr(basename($valueP),0,10). "</center>"; ?>
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
