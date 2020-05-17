<?php

	session_start();
	
	if ((!isset($_POST['table_name'])))
	{
		header('Location: create_new.php');
		exit();
	}

	require_once "connect.php";

	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($conn->connect_errno!=0)
	{
		$_SESSION['err']= "Error number " . $conn->connect_errno;
	}
	else
	{
        
        $conn->begin_transaction();
        $new_table_name = _POST['table_name'];
		
		$query = "CREATE TABLE '".$new_table_name."' (id int(11) NOT NULL, name text COLLATE utf8_polish_ci NOT NULL, quantity int(11) NOT NULL, price int(11) NOT NULL, expDate date NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;";

		if ($response = @$conn->query($query))
		{
            $_SESSION['success_msg'] = "Utworzono nową apteczkę";
            $conn->commit();
        }

        else
        {
            $conn->rollback;
            $_SESSION['err']= "Nazwa nie moze zawierać spacji";
			header('Location: create_new_form.php');
        }
		$conn->close();
	}
    header('Location: create_new_form.php');
	
?>