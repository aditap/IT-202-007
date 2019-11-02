<html>
	</head>
	<body>

	<div class="container">
		<h2 >AP National Bank</h2>

		<form action="checklogin.php" method="POST">
			Username: <input type="text" name="username" required="required"/><br/>
			Password: <input type="password" name="password" required="required"/><br/>
			<input type="submit" value="Login" class="button"/>
		</form>	
	</div>
	</body>
	
</html>
<?php 
	session_start();
	$user=mysql_real_escape_string($_POST['username']);
	$passwd=mysql_real_escape_string($_POST['password']);

	mysql_connect("localhost", "root", "") or die(mysql_error());
	mysql_select_db("userDB") or die("The database is offline");
	$query=mysql_query("SELECT * FROM users WHERE username = '$user'");
	$exists=mysql_num_rows($query);
	$table_user="";
	$table_password="";
	if($exists>0)
	{


		while($row=mysql_fetch_array($query))
		{
			$table_user=$row['username'];
			$table_password=$row['password'];
		}
		if($user== $table_user)
		{
			if($passwd==$table_password)
			{
				$_SESSION['user']= $user;
				header("location:home.php");
			}
			else
			{
				Print '<script>alert("Incorrect Password!");</script>';
				Print '<script>window.location.assign("login.php");</script>';
			}
		}
	}
	else
	{
		Print '<script>alert("Your username is incorrect!");</script>';
		Print '<script>window.location.assign("login.php");</script>';
	}
?>


