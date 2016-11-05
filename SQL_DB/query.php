<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SQL Query</title>
</head>
<body>
	<h3>Type the SELECT query below:</h3>
	<form action="" method="GET">
		<textarea name="query" cols="60" rows="8"></textarea><br/>
		<input type="submit" value="Submit">
	</form>

	<?php 
		// Create connection
		$db = new mysqli('localhost', 'cs143', '', 'CS143');
		// Check connection
		if($db->connect_errno > 0){
    		die('Unable to connect to database [' . $db->connect_error . ']');
		}
		// Check inputs
		if(isset($_GET['query'])) {
			$query = $_GET['query'];
			$result = $db->query($query);
			if ($result->num_rows > 0) {
	    		// output data of each row
				echo "<h3>Result from MySQL:</h3>";
				echo "<table border=\"1\"><tr>";
	    		while ($finfo = mysqli_fetch_field($result)) {
	    			echo "<th>{$finfo->name}</th>";

	    		}
	    		echo "</tr>";
	    		while($row = mysqli_fetch_array($result,MYSQLI_NUM)) {
	    			echo "<tr>";
    				foreach($row as $_column) {
    					if (is_null($_column)) {
    						echo "<td>N/A</td>";
    					} else {
        					echo "<td>{$_column}</td>";
        				}
    				}
    				echo "</tr>";
	    		}
	    		echo "</table>";
			} else {
	    		echo "No Record Found.";
			}
			$result->free();
			$db->close();
		} 
	?>
</body>
</html>