<?php
	include('bd.php');
	
	$message = $_POST['message'];

	$result_add_in_bd = mysql_query("INSERT INTO task (message) VALUES ('$message')");

	$result = mysql_query("SELECT * FROM task", $db);
	while($row = mysql_fetch_array($result))
	{
		echo "<input type='submit'class='btn btn-danger' onClick='del_message(this.id)' value='X' id='".$row['message']."'>  <label style='color: white'> *".$row['message']."</label><br>";
	}

?>