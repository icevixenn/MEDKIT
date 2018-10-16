<?php
session_start();
require_once 'conf/conf.php';
require_once "lang/$lang";
require_once "nagl.php";
require_once "pages/menu.php";



// Sprawdzanie czy zalogowano

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	header('location: pages/start.php');
	exit();
}

if((isset($_SESSION['udanarejestracja'])) && ($_SESSION['udanarejestracja']==true))
	{
	echo '<div class="alert alert-success" role="alert"><strong>' . $_SESSION['rejestracja'] . '</strong></div>';
	unset($_SESSION['udanarejestracja']);
	}
	
?>
<h1 align="center"><font size="10px"><br><?php echo $lgLogowanie;?></font></h1>
<div class="container" id="log-in-form">
        <div class="heading">
        </div>
        <form action="authentication/login.php" method="POST" role="form" style="display: block;">
            <div class="form-group">
                <input type="text" name="email" tabindex="1" class="form-control" placeholder=" <?php  echo $logEmailpch?>" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" tabindex="2" class="form-control" placeholder=" <?php  echo $logHaslopch?>" required>
            </div>
            <div class="form-group form-group-btn">
                <button type="submit" class="btn btn-success btn-lg">Zaloguj</button>
            </div>
            <div class="clearfix"></div>
            <div class="checkbox">
                    <a href="pages/register.php" class="active"><font color="black" size="4px"><b><?php echo $lgRejestracja;?></b></a></font>
            </div>
        </form>
    </div>	

<?php
	if(isset($_SESSION['blad']))	
	{
		echo '<div class="alert alert-danger" role="alert"><strong>' . $_SESSION['blad'] . '</strong></div>';
		unset($_SESSION['blad']);
	}
	
	require_once 'pages/stopka.php';
?>

	