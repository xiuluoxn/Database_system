<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Show Actor/Actress Detail</title>
</head>
<body>
	<!-- create connecting to database -->
	<?php 
		// Create connection
		$db = new mysqli('localhost', 'cs143', '', 'CS143');
		// Check connection
		if($db->connect_errno > 0){
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
	?>

	<h3>Actor Infomation Page:</h3>

	<!-- Actor/Actress Basic Info -->
	<div>
		<h4>Actor/Actress Basic Info:</h4>
		<?php 
			//check id
			if (!empty($_GET['id'])) {
				$id = $_GET['id'];
			}
			else {
				$err = true;
			}
			if (!$err) {
				//Fetch the data from the database
				$query = "SELECT CONCAT(first,' ',last) Name, sex, dob, dod FROM Actor WHERE id = '$id'";
				$result = $db->query($query);
				?>
				<!-- creat the table for the data -->
				<table border="1" style="width: 60%">
					<tr>
						<th>Name</th>
						<th>Sex</th>
						<th>Date of Birth</th>
						<th>Date of Death</th>
					</tr>
					<?php 
					while($row = $result->fetch_assoc()) {
			    		echo "<tr>";
		    			echo "<td>{$row['Name']}</td>";
		    			echo "<td>{$row['sex']}</td>";
		    			echo "<td>{$row['dob']}</td>";  
						if (is_null($row['dod'])) {
							echo "<td>Still Alive</td>";
						} else {
		    				echo "<td>{$row['dod']}</td>";  
		    			}	
		    			echo "</tr>";
			    	}
					?>
				</table>
				<?php 
			}
		?>
	</div>

	<!-- movie involved -->
	<div>
		<h4>Actor's Movies and Role::</h4>
		<?php 
			//check id
			if (!$err) {
				//Fetch the data from the database
				$query = "SELECT id, title, role FROM Movie M, MovieActor MA WHERE M.id = MA.mid AND aid = '$id';";
				$result = $db->query($query);
				?>
				<!-- creat the table for the data -->
				<table border="1" style="width: 40%">
					<tr>
						<th>Movie Title</th>
						<th>Roles</th>
					</tr>
					<?php 
					while($row = $result->fetch_assoc()) {
			    		echo "<tr>";
		    			echo "<td><a href=\"Show_Movie_Detail.php?id={$row['id']}\">{$row['title']}</a></td>";
		    			echo "<td>{$row['role']}</td>";
		    			echo "</tr>";
			    	}
					?>
				</table>
				<?php 
			}
		?>
	</div>
</body>
</html>