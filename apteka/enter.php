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
        $price = $_POST['price'];
        $expirationDate = $_POST['expirationDate'];

        $upper_name = strtoupper($name);
        $conn->begin_transaction();
        
        if($result = @$conn->query("SELECT NazwaHandlowa FROM ListaLekow WHERE NazwaHandlowa='$upper_name'"))
        {
            if($result->num_rows==0)
            {
                $_SESSION['err'] = "Podany lek nie istnieje w słowniku leków";
            }
        

            else
            {
                $query = "SELECT * FROM medicines WHERE name='$name' AND expDate='$expirationDate'";

		        if ($response = @$conn->query($query))
		        {
                    if($response->num_rows>0)
			        {
				        $dbentry = $response->fetch_assoc();

                        $quantity += $dbentry['quantity'];
					

                        $query = "UPDATE medicines SET quantity='$quantity' WHERE name='$name' AND expDate='$expirationDate'";
                        @$conn->query($query);
                    
                        $_SESSION['success_msg'] = "Poprawnie dodano do istniejacego";

                    }
                    else
                    {
                        $query = "INSERT INTO medicines VALUES (NULL, '$name', '$quantity', '$price', '$expirationDate')";
                        @$conn->query($query);	
                        
                        $_SESSION['success_msg'] = "Poprawnie dodano nowy";
                    }
                    $response->free_result();
                }
                else
                {
                    $_SESSION['err']= "Blad";

                }
                $conn->commit();
		        $conn->close();
	        }
            header('Location: enterform.php');
        }    
    }

?>