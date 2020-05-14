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
		$pass = $_POST['password'];
		
		$conn->begin_transaction();

		$query = "SELECT * FROM users WHERE mail='$mail'";

		if ($response = @$conn->query($query))
		{
			if($response->num_rows>0)
			{
				$dbentry = $response->fetch_assoc();

				if (password_verify($pass, $dbentry['pass']))
				{
					$_SESSION['logged'] = true;
					$_SESSION['name'] = $dbentry['name'];
					$_SESSION['lname'] = $dbentry['lname'];
					
					unset($_SESSION['err']);

					$response->free_result();
					
					header('Location: main.php');
				}
				else 
				{
					$_SESSION['err'] =  'Nieprawidłowy login lub hasło!';
					header('Location: index.php');
				}
				
			} else {
				
				$_SESSION['err'] =  'Nieprawidłowy login lub hasło!';
				header('Location: index.php');
				
			}
			
		}
		$conn->commit();
		$conn->close();
	}
	
?>