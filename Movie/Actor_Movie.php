<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Actor to Movie</title>
</head>
<body>
	<h3>Assign Actor to The Movie</h3>
	<form method="GET" action="#">
		<div>
			<label for="movie_list">Movie Title: </label><br>
			<select name="movie" id="movie_list">
			<option value="" disabled selected style="display: none;">Please Choose The Movie Title</option>
				<?php 
					$db = new mysqli('localhost', 'cs143', '', 'CS143');
					// Check connection
					if($db->connect_errno > 0){
			    		die('Unable to connect to database [' . $db->connect_error . ']');
					}
					// Select all the movie
					$query = "SELECT id, title, year FROM Movie";
					$result = $db->query($query);
					while($row = $result->fetch_assoc()) {
		    			?>
				    		<option value="<?php echo $row['id']; ?>">
				    			<?php echo $row['title'] . " (" . $row['year'] . ")"; ?>
							</option>
						<?php 
				    }
				?>
			</select>
		</div>
		<div>
			<label for="actor_list">Actor/Actress Name:</label><br>
			<select name="actor" id="actor_list">
			<option value="" disabled selected style="display: none;">Please Choose The Actor/Actress</option>
				<?php 
					// Select all the movie
					$query = "SELECT id, first, last, sex FROM Actor";
					$result = $db->query($query);
					while($row = $result->fetch_assoc()) {
		    			?>
				    		<option value="<?php echo $row['id']; ?>">
				    			<?php echo $row['first'] . " " . $row['last'] . " (" . $row['sex'] . ")"; ?>
							</option>
						<?php 
				    }
				?>
			</select>
		</div>
		<div>
			<label for="role">Role in the Movie:</label><br>
			<input type="text" id="role" placeholder="Role Name" name="role">
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
	<!-- update the database -->
	<?php 
		// check the value
		if (!empty($_GET['movie'])) {
			$mid = $_GET['movie'];
		}
		else {
			$err = true;
		}
		if (!empty($_GET['actor'])) {
			$aid = $_GET['actor'];
		}
		else {
			$err = true;
		}
		if (!empty($_GET['role'])) {
			$role = $_GET['role'];
		}
		else {
			$err = true;
		}
		// update to database
		if (!$err) {
			$query = "INSERT INTO MovieActor VALUES ('$mid', '$aid' ,'$role')";
			$result = $db->query($query);
		}
		// free the source
		$result->free();
		$db->close();
	 ?>
</body>
</html>