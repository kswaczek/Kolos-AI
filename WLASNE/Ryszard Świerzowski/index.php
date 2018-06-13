<?php
require_once('db.php');
global $con;
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Skrypt logowania z wykorzystaniem PHP i bazy MySQL</title>
</head>
<body>
	<form name="form-loging" action="index.php" method="post">
        login: <input type="text" name="login"/><br/>
        haslo: <input type="text" name="haslo"/><br/>
        <input type="submit" name="add" value="Zaloguj"/>
    </form>
	<?php

		if(isset($_POST['login']) && isset($_POST['haslo'])){
			if(!empty($_POST['login']) && !empty($_POST['haslo'])){
				$login = $con -> real_escape_string($_POST['login']);
				$haslo = $con -> real_escape_string($_POST['haslo']);
				$sql = $con -> query("SELECT * FROM `logowanie` WHERE `login` ='$login' AND `haslo` = '$haslo';");
				if ($sql -> num_rows > 0) header("location: zalogowano.php");
				else echo "<strong style='color: red;'>Nieudana próba zalogowania</strong>";
			}
			else echo "<strong style='color: red;'>Pola nie mogą być puste</strong>";
		}
	?>
	
</body>
</html>