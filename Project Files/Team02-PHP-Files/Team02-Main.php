<!DOCTYPE html>
<html>
    
    <head>
        <style>
            h1{color:red;}
            h3{color:blue;}
            body{background-color:pink;}
        </style>
    </head>

    <body>
        <h1>Welcome to the Food Delivery Service Page</h1>
        <h3>See what is the most delivered item in a restaurant</h3>

        <!-- Select Query 1  -->
        <form action="selectrest.php"  method="POST">
            Restaurant: <select name="form-restaurant">
            <?php
            $con = mysqli_connect("db.luddy.indiana.edu","i308u22_team02","my+sql=i308u22_team02", "i308u22_team02");
            
            if (!$con)
                {die("Failed to connect to MySQL: " . mysqli_connect_error()); }
            else
                {echo "Established Database Connection" . "<br>" ;}
            
            $result = mysqli_query($con, "SELECT DISTINCT restaurantID, rest_name FROM restaurant");
            while ($row = mysqli_fetch_assoc($result)){
                unset($id, $name);
                $id = $row['restaurantID'];
                $name = $row['rest_name'];
                echo '<option value = "' . $id . '">' . $name . '</option>';

            }
            ?>
            </select><br><br>
            <input type="Submit" value="View Results">    
        </form>


        <!-- Select Query 2 -->
        <h3>See which drivers has the most successful deliveries</h3>

		<form action="selectdriver.php" method="POST">
			Order: <select name="form-order">
                <option value="ASC">Smallest to Largest</option>
                <option value="DESC">Largest to Smallest</option>
            </select><br><br>
			<input type="submit" value="See the drivers"/>
		</form>


        <!-- Select Query 3 -->
        <h3>Identify the drivers that worked before a specified date</h3>
        <form action="selectdate.php">
            Select (date & time): <input type="datetime-local"><br><br>
            <input type="submit" value="View Results">
        </form>

        <!-- Select Query 4 -->
        <h3>Select a menu & enter a age </h3>
        <form action="selectage.php">
            Menu: <select name="form-rest">
            <?php
            $con = mysqli_connect("db.luddy.indiana.edu","i308u22_team02","my+sql=i308u22_team02", "i308u22_team02");
            
            if (!$con)
                {die("Failed to connect to MySQL: " . mysqli_connect_error()); }
            else
                {echo "Established Database Connection" . "<br>" ;}
            
            $result = mysqli_query($con, "SELECT DISTINCT menuID, menu_name FROM menu");
            while ($row = mysqli_fetch_assoc($result)){
                unset($id, $name);
                $id = $row['menuID'];
                $name = $row['menu_name'];
                echo '<option value = "' . $id . '">' . $name . '</option>';

            }
            ?>
            </select><br><br>

            Enter Number: <input type="number" name="form-age" min="18" max="60"><br><br>

            <input type="submit" value="View Result">

        </form>


        <!-- Select Query 5 -->
        <h3>Total revenue for restaurants top 3 sold items </h3>
        <form action="selecttop.php" method="POST">
            Restaurant: <select name="form-rest">
            <?php
            $con = mysqli_connect("db.luddy.indiana.edu","i308u22_team02","my+sql=i308u22_team02", "i308u22_team02");
            
            if (!$con)
                {die("Failed to connect to MySQL: " . mysqli_connect_error()); }
            else
                {echo "Established Database Connection" . "<br>" ;}
            
            $result = mysqli_query($con, "SELECT DISTINCT restaurantID, rest_name FROM restaurant");

            while ($row = mysqli_fetch_assoc($result)){
                unset($id, $name);
                $id = $row['restaurantID'];
                $name = $row['rest_name'];
                echo '<option value = "' . $id . '">' . $name . '</option>';

            }
            ?>
            </select><br><br>
            
            <input type="submit" value="View Results">
        </form>




    </body>




</html>