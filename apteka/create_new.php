<?php

	session_start();
	
	if ((!isset($_POST['tableName'])))
	{
		header('Location: create_new_form.php');
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
        $conn->autocommit(TRUE);
        $conn->begin_transaction();
		$new_table_name = $_POST['tableName'];

		$query = "SELECT * FROM apteczki WHERE name='$new_table_name';";

		    if ($response = @$conn->query($query))
		    {
                if($response->num_rows>0)
			        {
						$_SESSION['err'] = "Apteczka o tej nazwie juz istnieje";
					}
				else
				{
					$created_by = $_SESSION['name'];
					$query = "CREATE TABLE ".$new_table_name." (id int(11) PRIMARY KEY AUTO_INCREMENT, name text COLLATE utf8_polish_ci NOT NULL, quantity int(11) NOT NULL, price int(11) NOT NULL, expDate date NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;";
					$query .= "INSERT INTO apteczki (name, created_by) VALUES ('$new_table_name', '$created_by');";
					if ($response = @$conn->multi_query($query))
					{
						$_SESSION['success_msg'] = "Apteczka stworzona";
						$conn->commit();
        			}

        			else
        			{
						$conn->rollback;
						$_SESSION['err'] = "Niepoprawna nazwa".$query;
						header('Location: create_new_form.php');
        			}
				}
				$conn->close();
			}
		
		
	}
    header('Location: create_new_form.php');
	
?>