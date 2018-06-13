<?php
session_start();
if( 	isset($_POST['haslo']) && $_POST['haslo']=='tajne' 	){
	$_SESSION['zalogowany']=1;
	
}
if(!isset($_SESSION['zalogowany']))
{
	

?>
<html>
				<body>
						<form name="form-loging" action="test.php" method="post">
							
							haslo: <input type="text" name="haslo"/><br/>
							<input type="submit" name="add" value="Zaloguj"/>
						</form>
				</body>
</html>

<?php
} else {
	?>
	Tajne

<?php
}
?>




	
	

