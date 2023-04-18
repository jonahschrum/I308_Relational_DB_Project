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
$var_date = mysqli_real_escape_string($con, $_POST['form-driver']);

$select = "SELECT CONCAT(driver_fname, ' ' , driver_mname, ' ', driver_lname) as Name, driver_dob AS DOB, driver_phone AS phone, driver_email AS email
                FROM driver
                JOIN deliveries ON driver.driverID=deliveries.driverID
                WHERE delivery_time > '$var_date'
                GROUP BY DOB";

	
// Another variable that will take the value of $con which is the connection to database and the value of select which is a string acting as SQL statement        
$result = mysqli_query($con, $select);

if (mysqli_num_rows($result) > 0) {
        echo "<table> <tr> <th>Name</th> <th>DOB</th> <th>Phone</th> <th>Email</th> </tr>";
        while($row = mysqli_fetch_assoc($result)) {
     	
                        echo "<tr>";
                        echo "<td>" . $row["Name"] .  "</td> <td>" . $row["DOB"] .  "</td> <td>" . $row["phone"] . "</td> <td>" . $row["email"] . "</td>";
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
 
