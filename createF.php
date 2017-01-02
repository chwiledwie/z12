<?php
session_start();
$logCF = $_SESSION['login'];

// connect and login to FTP server
$ftp_server = "serwer1638898.home.pl";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login_result = ftp_login($ftp_conn, "chwiledwie@chwiledwie.pl", "Discovery76");

$dir = 'public_html/ChwileDwie/z12/clouds/'.$logCF.'/';

// try to create directory $dir
if (ftp_mkdir($ftp_conn, $dir.$_POST['katalog']))
  {
  echo "Successfully created $dir <br/>";
  echo 'Przejdź do panelu z plikami <a href="dysk.php#kom">tutaj</a>';
  }
else
  {
  echo "Error while creating $dir <br/>";
  echo 'Przejdź do panelu z plikami <a href="dysk.php#kom">tutaj</a>';
  }

// close connection
ftp_close($ftp_conn);

?>