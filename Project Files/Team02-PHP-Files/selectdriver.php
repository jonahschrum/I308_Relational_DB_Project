<?php
// Connection to the DB
$con = mysqli_connect("db.luddy.indiana.edu","i308u22_team02","my+sql=i308u22_team02", "i308u22_team02");

// Check Connection
if (!$con) {
	die("Failed to connect to MySQL: " . mysqli_connect_error()); 
}
else
    {echo "Established Database Connection" . "<br>" ;}

    
// Variables
$var_order = mysqli_real_escape_string($con, $_POST['form-order']);


$select = "SELECT d.driverID AS id, CONCAT(d.driver_fname, ' ', d.driver_lname) AS name, COUNT(del.driverID) AS CompletedOrders
                FROM driver AS d
                JOIN deliveries AS del
                ON del.driverID = d.driverID
                WHERE del.delivery_success_y_or_n = 'y'
                GROUP BY del.driverID
                ORDER BY COUNT(del.driverID) $var_order";
	
// Another variable that will take the value of $con which is the connection to database and the value of select which is a string acting as SQL statement        
$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0) {
        echo "<table> <tr> <th>ID</th> <th>Name</th> <th>Completed Orders</th> </tr>";
        while($row = mysqli_fetch_assoc($result)) {
     	
                        echo "<tr>";
                        echo "<td>" . $row["id"] .  "</td> <td>" . $row["name"] .  "</td> <td>" . $row["CompletedOrders"] . "</td>";
                        echo "</tr>";
        }
        echo "</table>";
}
else {
        echo "No Results";

}

mysqli_free_result($result);
mysqli_close($con);
?>
 





