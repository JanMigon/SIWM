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
        $table_name = $_POST['apteczka'];
        $conn->begin_transaction();
        $query = "SELECT * FROM {$table_name} WHERE name='$name' ORDER BY expDate ASC";

		if ($response = @$conn->query($query))
		{
            if($response->num_rows>0)
			{
                $flag = false;
                //fetch all records in asceding order by expiration date
                while($dbentry = $response->fetch_assoc()) 
                {
                    //check if available
                    if($dbentry['quantity'] - $quantity >= 0)
                    {
                        //check if expired
                        if(strtotime($dbentry['expDate']) >= getdate()['0'])
                        {
                            $quantity = $dbentry['quantity'] - $quantity;
                            $expirationDate = $dbentry['expDate'];
                            $query = "UPDATE {$table_name} SET quantity='$quantity' WHERE name='$name' AND expDate='$expirationDate'";
                            @$conn->query($query);
                            $flag = true;
                            break;
                        }
                    }
                }

                if($flag) $_SESSION['success_msg'] = "Wydano lek";
                else $_SESSION['err'] = "Nie ma takiej ilości leku";
            }
            else
            {
                $_SESSION['err'] = "Brak leku";
            }
            $response->free_result();
        }
        else
        {
            $_SESSION['msg']= "Blad";

        }
        $conn->commit();
		$conn->close();
	}
    header('Location: giveform.php');
	
?>