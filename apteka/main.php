<?php

include('head.php');
?>

<div class="col-sm">

<?php

require_once "connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno!=0)
{
    $_SESSION['msg']= "Error number " . $conn->connect_errno;
}
else
{
    $conn->begin_transaction();
    $query = "SELECT * FROM medicines WHERE quantity>0";

    if ($result = @$conn->query($query))
    {
        if($result->num_rows>0)
        {
            echo('<table><td>Nazwa</td><td>Ilość</td><td>Data ważności</td><tr>');
            
            while($dbentry = $result->fetch_assoc()) 
            {                
                $name = $dbentry['name'];
                $quantity = $dbentry['quantity'];
                $expDate = $dbentry['expDate'];	
                        
                echo("<td width='50' align='center'> {$name} </td><td width='100' align='center'>  {$quantity} </td>");

                if(strtotime($dbentry['expDate']) >= getdate()['0'])
                {
                   echo('<td width="100" align="center">'.$expDate.'</td>');
                }
                else
                {
                    echo('<td width="100" align="center" class="text-danger">'.$expDate.'</td>');
                }
                echo ('
                </tr>
                <tr>
                ');
            }

            echo('</table>');
        }
        $conn->commit();
		$conn->close();
    }
}	

?>
</div>

<?php

include('foot.html');

?>