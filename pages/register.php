<?php 
	session_start();
	
	require_once '../conf/conf.php';
	require_once "../lang/$lang";
	require_once "nagl.php";
	require_once "menu.php";
		

	
	if (isset($_POST['email'])) // sprawdzamy czy dane zostaly wpisane
	{
		//Udana walidacja?
		$wszystko_OK=true;

		$imie = $_POST['name'];
		$nazwisko = $_POST['surname'];
		$email = $_POST['email'];
		$haslo1 = $_POST['password'];
		$haslo2 = $_POST['pass_rep'];
		

		// do zastosowania do normalnego serwera, który ma wersje php z tego wieku ;)
		// hashowanie hasla! gotowa funkcja
		// Password_default - algorytm hasujacy bazy danych obecnie uzywany
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		//$haslo_hash = md5($haslo1);
		
		//Bot or not?
		$sekret = "6LdHLCAUAAAAANYuWxUl4m4BRJZ3tXio-LtrJUVh";
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if ($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
		}		
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_imie'] = $imie;
		$_SESSION['fr_nazwisko'] = $nazwisko;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
 
		mysqli_report(MYSQLI_REPORT_STRICT); // sposób raportowania błędów
		// zamiast WARNING dostajemy EXEPTIONS, 
		//nie wyświetla brzydko błedu np nazwy hosta
		
		// łączenie się z bazą danych
		try 
		{
			$baza = new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);
			$baza->set_charset("utf8");
			if ($baza->connect_errno!=0) // 0 - udane połączenie
			{
				throw new Exception(mysqli_connect_errno()); // wyrzuć nr błędu jeśli połączenie z bazą nie wyjdzie
			}
			else
			{
				//Czy email już istnieje? logowanie za pomoca maili, wiec nie mozna sie na ten sam rejestrowac
				$rezultat = $baza->query("SELECT idkonta FROM users WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($baza->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		
				
				if ($wszystko_OK==true) // koniec warunków, wszystko dobrze wpisane
				{
					
					if ($baza->query("INSERT INTO users VALUES (NULL, '$imie', '$nazwisko', '$email', '$haslo_hash')"))
					{
						$_SESSION['udanarejestracja']=true;
						$_SESSION['rejestracja'] = 'Dziękujemy za rejestrację! Zaloguj się, by móc korzystać z apteczki.';
						header('Location: ../index.php');
					}
					else
					{
						throw new Exception($baza->error);
					}
					
				}
				
				$baza->close();
			}
			
		}
		catch(customException $e) // 'złap' wyjątek
		{
			echo $e->errorMessage();
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		}
		
	}
?>

<div class="col-md-1">
</div>
<div id="tresc" class="col-md-10">

<div>
<form class="form-horizontal" method="POST" id="registration">
    <fieldset>

        <legend>Rejestracja</legend> 
		
		<div class="form-group">
          <label class="col-md-4 control-label" for="imie"><?php echo $rejImie;?> </label>  
          <div class="col-md-4">
          <input id="name" name="name" type="text" value="<?php
			if (isset($_SESSION['fr_imie']))
			{
				echo $_SESSION['fr_imie'];
				unset($_SESSION['fr_imie']);
			}
		?>" placeholder="Imię" class="form-control input-md" required="">  
          </div>
        </div>
		
		<div class="form-group">
          <label class="col-md-4 control-label" for="nazwisko"><?php echo $rejNazwisko;?> </label>  
          <div class="col-md-4">
          <input id="surname" name="surname" type="text" value="<?php
			if (isset($_SESSION['fr_nazwisko']))
			{
				echo $_SESSION['fr_nazwisko'];
				unset($_SESSION['fr_nazwisko']);
			}
		?>" placeholder="Nazwisko" class="form-control input-md" required="">  
          </div>
        </div>
		
		<div class="form-group">
          <label class="col-md-4 control-label" for="email"><?php echo $rejEmail;?> </label>  
          <div class="col-md-4">
          <input id="email" name="email" type="text" value="<?php
			if (isset($_SESSION['fr_email']))
			{
				echo $_SESSION['fr_email'];
				unset($_SESSION['fr_email']);
			}
		?>" placeholder="e-mail" class="form-control input-md" required=""> 
          </div>
        </div>

		<div class="form-group">
          <label class="col-md-4 control-label" for="haslo1"><?php echo $rejHaslo;?> </label>
          <div class="col-md-4">
            <input id="password" name="password" type="password" value="<?php
			if (isset($_SESSION['fr_haslo1']))
			{
				echo $_SESSION['fr_haslo1'];
				unset($_SESSION['fr_haslo1']);
			}
		?>" placeholder="Hasło " class="form-control input-md" required="">
          </div>
        </div>	
		
		<div class="form-group">
          <label class="col-md-4 control-label" for="haslo2"><?php echo $rejPowHaslo;?> </label>
          <div class="col-md-4">
            <input id="pass_rep" name="pass_rep" type="password" value="<?php
			if (isset($_SESSION['fr_haslo2']))
			{
				echo $_SESSION['fr_haslo2'];
				unset($_SESSION['fr_haslo2']);
			}
		?>" placeholder="Hasło" class="form-control input-md" required="">
          </div>
        </div>	
		
		  <div class="g-recaptcha" data-sitekey="6LdHLCAUAAAAAMUNjpVYcPNZyp72NiBKyzj2aJTV" align="center" ></div> 
		
		<br />
		
		<div class="form-group">
          <label class="col-md-4 control-label" for="save"></label>
          <div class="col-md-8">
            <input type="submit" value="Zarejestruj się" class="btn btn-success" />
          </div>
        </div>

        </fieldset>
        </form>

<?php
	if (isset($_SESSION['e_bot']))
	{
		echo '<div class="alert alert-danger" role="alert">
  				<strong>'.$_SESSION['e_bot'].'</strong></div>';
		unset($_SESSION['e_bot']);
	}
?>
<?php
	if (isset($_SESSION['e_email']))
	{
		echo '<div class="alert alert-danger" role="alert">
  				<strong>'.$_SESSION['e_email'].'</strong></div>';
		unset($_SESSION['e_email']);
	}
?>

</div>
<script>
/*
 * walidacja formularza rejestracji
*/  

$(document).ready(function () {

    $('#registration').validate({
    	'errorClass': 'ui-state-error-text',
        'highlight': function (element, errorClass) {
            $(element).addClass('ui-state-error');
        },
        'unhighlight': function (element, errorClass) {
            $(element).removeClass('ui-state-error');
          //  $(element).addClass('ui-state-checked'); na żółto się robi
        },
    	rules: {
        	name: {
                required: true,
                minlength: 2
            },
            surname: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            pass_rep: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            consent: "required"
        },
        messages: {
        	name: {
        		required: "Proszę podać imię",
        		minlength: "Imię musi posiadać co najmniej 2 litery"
        	},
        	surname: {
        		required: "Proszę podać nazwisko",
        		minlength: "Nazwisko musi posiadać co najmniej 2 litery"
        	},
        	email: {
        		required: "Proszę podać adres e-mail",
        		email: "Proszę podać poprawny adres e-mail"
        	},
        	password: {
        		required: "Proszę podać hasło",
        		minlength: "Hasło musi zawierać co najmniej 6 znaków"
        	},
        	pass_rep: {
        		required: "Proszę powtórzyć hasło",
        		minlength: "Hasło musi zawierać co najmniej 6 znaków",
        		equalTo: "Podane hasła muszą być identyczne"
        	},
        	consent: "Proszę zaakceptować regulamin rejestracji"
        }
    });

});
</script>
	
	</div>

</body>
</html>

	<?php 
		require_once 'stopka.php';
	?>