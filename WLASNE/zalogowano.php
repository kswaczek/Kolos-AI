<?php
require_once('db.php');
global $con;

	

if(!isset($_SESSION['zalogowany']))
{
	$_SESSION['loginPrzedEdycja'];
	$_SESSION['hasloPrzedEdycja'];
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Skrypt logowania z wykorzystaniem PHP i bazy MySQL</title>
	<!-- <meta http-equiv="Refresh" content="3" />  <!--   -->
	
	
</head>
<body>


	<a href="index.php">Index</a>
<!--
################################################################################################################################
################################################ FORMULARZ DODAWANIA 
################################################################################################################################ -->	
	
	<form name="form-loging" action="zalogowano.php" method="post">
        login: <input type="text" name="login"/><br/>
        haslo: <input type="text" name="haslo"/><br/>
        <input type="submit" name="add" value="Dodaj użytkownika"/>
		
    </form>

	<?php

		if(isset($_POST['login']) && isset($_POST['haslo'])){
			if(!empty($_POST['login']) && !empty($_POST['haslo'])){
				$login = $con -> real_escape_string($_POST['login']);
				$haslo = $con -> real_escape_string($_POST['haslo']);
				
				$sql = $con -> query("SELECT * FROM `logowanie` WHERE `login` ='$login' AND `haslo` = '$haslo';");// sprawdzenie czy podane haslo istnieje
				if ($sql -> num_rows > 0)  echo "<strong style='color: red;'>Nieudana dodania</strong>";
				else  $sql = $con -> query("INSERT INTO `logowanie` (`haslo`,`login`) VALUES('$haslo','$login');"); // dodanie do tabeli
			}
			else echo "<strong style='color: red;'>Pola nie mogą być puste</strong>";
		}
	?>

	
<!--
################################################################################################################################
################################################ TABELA WYNIKÓW Z BAZY 
################################################################################################################################ -->		
	<?php
		$index = 0; 
		$tabDane=[];
		$tabTemp=[];
	
		echo "<table border=1><tr><td>Login:</td><td>Haslo</td><td>Usuń</td><td>Edytuj</td></tr>";
		$sql = $con -> query("SELECT * FROM `logowanie`;");
		while ($count = $sql -> fetch_row()){
			echo "<form action='' method=post>
			<input type=hidden value=$count[0]>
			<tr>
				<td>$count[0]</td>
				<td>$count[1]</td>
				<td><input type=submit name=edit$index value=Edytuj/></td>
				<td><input type=submit name=delete$index   value=Usuń/></td>
			</tr>
			</form>";
			$tabTemp[0]=$count[0];
			$tabTemp[1]=$count[1];
			array_push($tabDane,$tabTemp);
			$index++;
			
		}
		echo "</table>";


//################################################################################################################################
//################################################ DZIAŁANIE PRZYCISKÓW edytuj usun zapisz 
//################################################################################################################################ 	
		

		
		if(isset($_POST) )
		{
			
			for($i=0; $i<56; $i++)
			{
				if(isset($_POST['edit'.$i]) ) 
				{
					$tab=$tabDane[$i];
					$editLogin=$tab[0];
					$editPass=$tab[1];
					$_SESSION['loginPrzedEdycja']=$editLogin;
					$_SESSION['hasloPrzedEdycja']=$editPass;
					echo    "<form action='' method='post'>
								Zmień Login: <input type='text' name='poleEdycjiLoginu'  /> <br>   <!---value='$editLogin'-->
								Zmień Hasło: <input type='text'name='poleEdycjiPass' /> <br>       <!---value='$editPass'-->
											 <input type='submit' name='EdytujWBazie' value='Zapisz zmiany'/>	
							</form>";
					
				



				
				}
				if(isset($_POST['delete'.$i]) ) 
				{
					$tab=$tabDane[$i];
					$delLogin=$tab[0];
					$delPass=$tab[1];
					$sql = $con -> query("DELETE FROM `logowanie` WHERE `login` ='$delLogin' AND `haslo` = '$delPass';");
				}
			}
			
			if(isset($_POST['EdytujWBazie']))
			{
				if(!empty($_POST['poleEdycjiLoginu']) && !empty($_POST['poleEdycjiPass']))
				{
					$loginPrzedEdycja = $_SESSION['loginPrzedEdycja'];	
					$hasloPrzedEdycja = $_SESSION['hasloPrzedEdycja'];
					
					$login = $con -> real_escape_string($_POST['poleEdycjiLoginu']);
					$haslo = $con -> real_escape_string($_POST['poleEdycjiPass']);
					$sql = $con -> query("UPDATE `logowanie` SET  `login`='$login',`haslo`='$haslo' WHERE `login` ='$loginPrzedEdycja' AND `haslo` = '$hasloPrzedEdycja';");//SET  `login`=$loginPrzedEdycja WHERE `login` ='$loginPrzedEdycja' AND `haslo` = '$hasloPrzedEdycja'
					header('refresh: 1;');
				}
				else echo "<strong style='color: red;'>Pola nie mogą być puste</strong>";
			}
		}
	?>

</body>
</html>











