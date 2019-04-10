<?php
	include("bd.php");

	$message = $_POST['message'];

	$result_delete = mysql_query("DELETE FROM task WHERE message='$message'",$db);

	$result = mysql_query("SELECT * FROM task", $db);
		while($row = mysql_fetch_array($result))
		{
			echo "<input type='submit'class='btn btn-danger' onClick='del_message(this.id)' value='X' id='".$row['message']."'>  <label style='color: white'> *".$row['message']."</label><br>";
		}


?>