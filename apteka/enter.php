<?php

	session_start();
	
	if ((!isset($_POST['name'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($conn->connect_errno!=0)
	{
		$_SESSION['msg']= "Error number " . $conn->connect_errno;
	}
	else
	{
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $expirationDate = $_POST['expirationDate'];

        $query = "SELECT * FROM medicines WHERE name='$name' AND expDate='$expirationDate'";

		if ($response = @$conn->query($query))
		{
            if($response->num_rows>0)
			{
				$dbentry = $response->fetch_assoc();

                $quantity += $dbentry['quantity'];
					

                $query = "UPDATE medicines SET quantity='$quantity' WHERE name='$name' AND expDate='$expirationDate'";
                @$conn->query($query);
                    
                $_SESSION['msg'] = "Poprawnie dodano do istniejacego";

            }
            else
            {
                $query = "INSERT INTO medicines VALUES (NULL, '$name', '$quantity', '$expirationDate')";
                @$conn->query($query);	
                        
                $_SESSION['msg'] = "Poprawnie dodano nowy";
            }
            $response->free_result();
        }
        else
        {
            $_SESSION['msg']= "Blad";

        }

		$conn->close();
	}
    header('Location: enterform.php');
	
?>