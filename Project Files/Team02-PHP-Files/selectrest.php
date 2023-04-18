<?php

// Connection to the DB
$con = mysqli_connect("db.luddy.indiana.edu","i308u22_team02","my+sql=i308u22_team02", "i308u22_team02");


// Check Connection
if (!$con) {
	die("Failed to connect to MySQL: " . mysqli_connect_error()); 
}
else
    {echo "Established Database Connection" . "<br>" ;}

// Variable that will hold the input value from the user
$var_restaurant = mysqli_real_escape_string($con, $_POST['form-restaurant']);

// A variable assigned to a string that will act as SQL Select Statment when passed into the database
$select = "SELECT f.item_name AS Food, COUNT(f.itemID) AS Total, r.rest_name AS RestName
                FROM deliveries AS d
                JOIN orders AS o 
                ON o.orderID = d.orderID 
                JOIN food_items AS f                                           
                ON o.itemID = f.itemID
                JOIN menu AS m                                        
                ON m.menuID = f.itemID
                JOIN restaurant AS r                                        
                ON m.restaurantID = r.restaurantID
                WHERE r.restaurantID = '$var_restaurant'
                GROUP BY f.itemID";

// echo $select;

// Another variable that will take the value of $con which is the connection to database and the value of select which is a string acting as SQL statement
$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0) {
        echo "<table> <tr> <th>Food</th> <th>Count </th> <th>RestName</th> </tr>";
        while($row = mysqli_fetch_assoc($result)) {

                        echo "<tr>";
                        echo "<td>" . $row["Food"] . "</td> <td>" . $row["Total"] . "</td> <td>" . $row["RestName"] . "</td>";
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