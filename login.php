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
<form method="post" action="login2.php">
           <div class="form-group">
   <label class="control-label" for="login">
       Login:
      </label>
               <input class="form-control" id="contactname" name="login" type="text"/>
           </div>
           
           <div class="form-group">
  <label class="control-label" for="password">
       Hasło:
      </label>
               <input class="form-control" id="contactname" name="password" type="password"/>
           </div>
           
           <div class="form-group" >
  <input type="hidden" name="send" value="1" />
  <input id="bs" class="btn-success" type="submit" value="Zaloguj" />
  <a href="register.php" class="btn btn-inverse" role="button">Zarejestruj</a>
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







