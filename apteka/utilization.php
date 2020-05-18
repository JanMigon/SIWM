<?php

	session_start();
	
	if ((!isset($_SESSION['logged'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	
	$conn->begin_transaction();
	if ($conn->connect_errno!=0)
	{
		$_SESSION['msg']= "Error number " . $conn->connect_errno;
	}
	else
	{
		$query = "SELECT * FROM apteczki ORDER BY date ASC;";
    	if ($result = @$conn->query($query))
    	{
        	while($apteczka = $result->fetch_assoc())
        	{
            	$table_name = $apteczka['name'];
		
				$query = "DELETE FROM {$table_name} WHERE UNIX_TIMESTAMP() > UNIX_TIMESTAMP(expDate)";

				@$conn->query($query);
			}
		}
		$conn->commit();
		$conn->close();
    }
    
    header('Location: main.php');
	
?>