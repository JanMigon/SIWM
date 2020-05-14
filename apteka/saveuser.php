<?php

	session_start();
	
	if ((!isset($_POST['mail'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($conn->connect_errno!=0)
	{
		$_SESSION['err']= "Error number " . $conn->connect_errno;
		header('Location: index.php');
	}
	else
	{
		$mail = $_POST['mail'];
		$name = $_POST['name'];
		$lname = $_POST['lname'];
		$pass = $_POST['password'];

		$conn->begin_transaction();
		
		$query = "SELECT * FROM users WHERE mail='$mail'";

		if ($response = @$conn->query($query))
		{
			if($response->num_rows>0)
			{
				$_SESSION['err']="Wykorzystany mail";
				$conn->close();
				header('Location: signup.php');
				exit();
			}
			else
			{
				$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
				$query = "INSERT INTO users VALUES (NULL, '$name', '$lname', '$mail', '$hashed_password')";
				@$conn->query($query);	
				
				$_SESSION['logged']=true;
				$_SESSION['name']=$name;
				$_SESSION['lname']=$lname;
				header('Location: main.php');
				
			}
		}	
		$conn->commit();
		$conn->close();
	}

	
?>