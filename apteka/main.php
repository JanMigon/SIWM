<?php

include('head.php');
?>

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
    $query = "SELECT * FROM apteczki ORDER BY date ASC;";
    if ($result = @$conn->query($query))
    {
        echo('<div class="container">');
        while($apteczka = $result->fetch_assoc())
        {
            $table_name = $apteczka['name'];
            $created_at = $apteczka['date'];
            $created_by = $apteczka['created_by'];
            echo('<p>Apteczka "'.$table_name.'" stworzona '.$created_at.' przez '.$created_by.'</p>');
            echo('<table class="table">');
            echo('<thead><tr><th scope="col">Nr</th><th scope="col">Nazwa</th><th scope="col">Ilość</th><th scope="col">Data wazności</th></tr></thead>');
            echo('<tbody>');   
            $query = "SELECT * FROM {$table_name} WHERE quantity>0";
            if ($response = @$conn->query($query))
            {
                if($response->num_rows>0)
                {
                    $cnt = 1;
                    while($dbentry = $response->fetch_assoc())
                    {
                        $name = $dbentry['name'];
                        $quantity = $dbentry['quantity'];
                        $expDate = $dbentry['expDate'];	
                        echo('<tr><th scope="row">'.$cnt.'</th>');
                        echo("<td>{$name}</td><td>{$quantity}</td>");

                        if(strtotime($dbentry['expDate']) >= getdate()['0'])
                        {
                            echo('<td>'.$expDate.'</td>');
                        }
                        else
                        {
                            echo('<td class="text-danger">'.$expDate.'</td>');
                        }
                        echo('</tr>');
                        $cnt++;
                    }
                }
            
            }
            echo('</tbody>');
            echo('</table>');
            echo('<br>');
        }
        echo('</div>');
        $conn->commit();
		$conn->close();
    }   
}   
    
?>

<div class="row">
    <div class="col-sm">
        <p class="text-danger">
            <?php
                if(isset($_SESSION['msg']))	{ echo($_SESSION['err']); unset($_SESSION['msg']);}
            ?>
        </p>
        <p class="text-success">
            <?php
                if(isset($_SESSION['success_msg']))	{ echo($_SESSION['success_msg']); unset($_SESSION['success_msg']);}
            ?>
        </p>
    </div>
</div>

<?php

include('foot.html');

?>