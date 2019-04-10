<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap уроки</title>
	<link href="https://fonts.googleapis.com/css?family=Spicy+Rice" rel="stylesheet">
		<!-- Последняя компиляция и сжатый CSS -->  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Дополнение к теме -->  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	
	<style>
		body{
			background: url(image1.jpg);
		}
		.navbar {
			font-family: 'Spicy Rice', cursive;
		}
	</style>
</head>
<body>
	<div class="conteiner">
		<h1 class="text-center navbar" style="color: white"><big>Todo list <small><br>Welcome to my todo list</small></h1>
			<div align="middle">
				<form class="form-inline">
					<input type="text" id="message" class="form-control navbar" placeholder="Enter your message">
					<label id="add"  class="btn btn-success navbar" onclick="add_message(this.id)">Add message</label>
				</form>
			</div>

	</div>
	<div>
		<ul id="result">

			<?php
					include("bd.php");	$result = mysql_query("SELECT * FROM task", $db);
					while($row = mysql_fetch_array($result))
					{
						echo "<input type='submit'class='btn btn-danger' onClick='del_message(this.id)' value='X' id='".$row['message']."'>  <label style='color: white'> *".$row['message']."</label><br>";
					}
			?>

		</ul>
	</div>
	<script type="text/javascript">
		function add_message(id)
		{
			var url = 'add.php';
			var message = document.getElementById("message").value
			var params = 'message='+ message;
			ajaxPost(url, params).then(function(resolve)
			{
				document.querySelector('#result').innerHTML = resolve;
			}).catch(function(reject)
			{
				document.querySelector('#result').innerHTML = reject;
			});
			document.getElementById("message").value = '';
		}

		function del_message(id)
		{
			var url = 'del.php';
			var params = 'message=' + id;
			ajaxPost(url,params).then(function(resolve)
			{
				document.querySelector('#result').innerHTML = resolve;	   
			}).catch(function(reject)
			{
				console.log('123');
				document.querySelector('#result').innerHTML = reject;
			});
		}


		function ajaxPost(url, params)
		{
			return new Promise(function(resolve, reject)
			{
				var request = new XMLHttpRequest;
				request.open('POST',url,true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				request.addEventListener("load", function()
				{
					if(request.status < 400)
					{
						resolve(request.responseText);
					}
					else
					{
						reject(Error("Ошибка получения данных"));
					}
				});
				request.send(params);
			});
		}

	</script>
</body>
</html>