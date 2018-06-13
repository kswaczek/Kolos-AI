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
        Imię: <input type="text" name="name"/><br/>
        Nazwisko: <input type="text" name="surname"/><br/>
        Numer albumu: <input type="text" name="number_id"/><br/>
        <input type="submit" name="add" value="Dodaj studenta"/>
    </form>
	<?php

		if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['number_id'])){
			if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['number_id'])){
				$name = $con -> real_escape_string($_POST['name']);
				$surname = $con -> real_escape_string($_POST['surname']);
				$number_id = $con -> real_escape_string($_POST['number_id']);
				$sql = $con -> query("INSERT INTO `student` VALUES ('$name','$surname', '$number_id');");
				if ($con -> affected_rows) echo "<strong style='color: green;'>Dodano studenta do systemu</strong>";
				else echo "<strong style='color: red;'>Nieudana próba dodania studenta</strong>";
			}
			else echo "<strong style='color: red;'>Pola nie mogą być puste</strong>";
		}
	?>
	<form name="form-loging" action="index.php" method="post">
        Wyszukaj studenta o: <input type="text" name="seek"/><br/>
        <input type="radio" name="parameter" value="name"/>Imię<br/>
        <input type="radio" name="parameter" value="surname"/>Nazwisko<br/>
        <input type="radio" name="parameter" value="number_id"/>Numer albumu<br/>
        <input type="submit" name="find" value="Wyszukaj"/>
    </form>
	<?php
		if(isset($_POST['parameter']) && !empty($_POST['parameter']) && isset($_POST['seek']) && !empty($_POST['seek'])){
				$parameter = $con -> real_escape_string($_POST['parameter']);
				$seek = $con -> real_escape_string($_POST['seek']);
				$sql = $con -> query("SELECT * FROM `student` WHERE `$parameter` = '$seek';");
				while ($count = $sql -> fetch_row()){
					echo "Imię: $count[0] Nazwisko: $count[1] Numer albumu: $count[2]";
				}
			}
			else{
				echo "<strong style='color: red;'>Pola nie mogą być puste</strong>";
		}
		echo "<table border=1><tr><td>Imię:</td><td>Nazwisko</td><td>Numer albumu</td><td>Usuń</td><td>Edytuj</td></tr>";
		$sql = $con -> query("SELECT * FROM `student`;");
		while ($count = $sql -> fetch_row()){
			echo "<tr><td>$count[0]</td><td>$count[1]</td><td>$count[2]</td><td><input type=submit name=delete value=Usuń></td><td><input type=submit name=edit value=Edytuj formmethod></td></tr>";
		}
		echo "</table>";
	?>
</body>
</html>