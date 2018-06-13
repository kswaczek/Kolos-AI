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
	<a href="index.php">Index</a>
	
	<?php
		echo "<table border=1><tr><td>Login:</td><td>Haslo</td><td>Usuń</td><td>Edytuj</td></tr>";
		$sql = $con -> query("SELECT * FROM `logowanie`;");
		while ($count = $sql -> fetch_row()){
			echo "<tr><td>$count[0]</td><td>$count[1]</td><td><input type=submit name=delete value=Usuń></td><td><input type=submit name=edit value=Edytuj formmethod></td></tr>";
		}
		echo "</table>";
	?>
</body>
</html>