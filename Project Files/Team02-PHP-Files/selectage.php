<?php

// Connection to the DB
$con = mysqli_connect("db.luddy.indiana.edu","i308u22_team02","my+sql=i308u22_team02","i308u22_team02");



// Check Connection
if (!$con) {
	die("Failed to connect to MySQL: " . mysqli_connect_error()); 
}
else
    {echo "Established Database Connection" . "<br>" ;}


$var_age = mysqli_escape_real_string($con, $_POST['form-age']);
$rest_name = mysqli_escape_real_string($con, $_POST['form-rest']);

$select = "SELECT COUNT(*) as count
FROM menu
JOIN food_items ON menu.menuID = food_items.itemID
JOIN purchase_ticket ON food_items.itemID=purchase_ticket.itemID
JOIN orders ON purchase_ticket.orderID=orders.orderID
JOIN deliveries ON orders.orderID=deliveries.orderID
JOIN driver ON deliveries.driverID=driver.driverID
WHERE menu_name = '$rest_name' AND '$var_age' < (DATEDIFF(CURDATE(), driver_dob)/365)";
 

$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0) {
        echo "<table> <tr> <th>Count</th> </tr>";
        while($row = mysqli_fetch_assoc($result)) {
     	
                        echo "<tr>";
                        echo "<td>" . $row["count"] . "</td>";
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
