<?php

// Connection to the DB
$con = mysqli_connect("db.luddy.indiana.edu","i308u22_team02","my+sql=i308u22_team02","i308u22_team02");

// Check Connection
if (!$con) {
	die("Failed to connect to MySQL: " . mysqli_connect_error()); 
}
else
    {echo "Established Database Connection" . "<br>" ;}

// Variable(s) that will hold the input value from the user in the main form php
$var_rest = mysqli_real_escape_string($con, $_POST['form-rest']);



$select = "SELECT p.itemID AS Item, SUM(purchases) AS Total_Revenue, r.rest_name AS RestName  
		FROM purchase_ticket AS p 
		JOIN orders as o ON  o.orderID = p.orderID 
		JOIN food_items AS f                                           
		ON o.itemID = f.itemID
		JOIN menu AS m                                        
		ON m.menuID = f.itemID
		JOIN restaurant AS r                                        
		ON m.restaurantID = r.restaurantID
        WHERE r.restaurantID = '$var_rest'
        GROUP BY p.orderID 
        ORDER BY SUM(p.purchases) DESC 
        LIMIT 3 ";

// echo $select;

// Another variable that will take the value of $con which is the connection to database and the value of select which is a string acting as SQL statement
$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0) {
        echo "<table> <tr> <th>Order</th> <th>Total Revenue</th> <th>Restaurant Name</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
     	
                        echo "<tr>";
                        echo "<td>" . $row["Item"] . "</td> <td>" . $row["Total_Revenue"] . "</td> <td>" . $row["RestName"] . "</td>";
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