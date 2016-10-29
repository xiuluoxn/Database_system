<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Show the Actor</title>
</head>
<body>
	<h3>Search The Actor/Actress/Movie:</h3>
	<form method = "GET" action="#">
		<div>
			<label for="name">Search:</label><br>
			<input type="text" id="name" placeholder="Part of the name" name="name"><br>
		</div>
		<button type="submit" class="btn btn-default">Search</button>
	</form>

	 <?php 
		// Create connection
		$db = new mysqli('localhost', 'cs143', '', 'CS143');
		// Check connection
		if($db->connect_errno > 0){
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		if (!empty($_GET['name'])) {
			$input = $_GET['name'];
		}
		else {
			$err = true;
		}
		// Select
		if (!$err) {
			//SELECT Actor/Actress
			$query = "SELECT id, CONCAT(first,' ',last) Name, dob FROM Actor WHERE UPPER(CONCAT(first,' ',last)) LIKE UPPER('%$input%')";
			$result = $db->query($query);
			?>
			<div>
				<h3>Matched Actor/Actress:</h3>
				<?php if ($result->num_rows > 0): ?>
					<table border="1" style="width:30%">
						<tr>
							<th>Name</th>
							<th>Date of Birth</th>
							<th></th>
						</tr>
						<?php 
						while($row = $result->fetch_assoc()) {
							    		echo "<tr>";
						    			echo "<td>{$row['Name']}</td>";
						    			echo "<td>{$row['dob']}</td>";  
						    			echo "<td><a href=\"Show_Actor_Detail.php?id={$row['id']}\">Show Detail</a></td>";  			
						    			echo "</tr>";
							    	}
						?>
					</table>
				<?php else: ?>
					<p>No Record Found</p>
				<?php endif ?>
			</div>
			<?php
			//SELECT Movie
			$query = "SELECT id, title, year FROM Movie WHERE UPPER(title) LIKE UPPER('%$input%')";
			$result = $db->query($query);
			?>
			<div>
				<h3>Matched Movie:</h3>
				<?php if ($result->num_rows > 0): ?>
					<table border="1" style="width:30%">
						<tr>
							<th>Title</th>
							<th>Year Produced</th>
							<th></th>
						</tra>
						<?php 
						while($row = $result->fetch_assoc()) {
							    		echo "<tr>";
						    			echo "<td>{$row['title']}</td>";
						    			echo "<td>{$row['year']}</td>";  
						    			echo "<td><a href=\"Show_Movie_Detail.php?id={$row['id']}\">Show Detail</a></td>";    			
						    			echo "</tr>";
							    	}
						?>
					</table>
				<?php else: ?>
					<p>No Record Found</p>
				<?php endif ?>
			</div>
			<?php 
		}
		$result->free();
		$db->close();
	?>
</body>
</html>

