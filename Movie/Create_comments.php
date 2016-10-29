<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Comments</title>
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

		// check get parametre
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
		}
		else {
			$err = true;
		}
		
		if (!$err) {
			//Fetch the name of movie from the table Movie
			$query = "SELECT title FROM Movie WHERE id = '$id'";
			$result = $db->query($query);
			while($row = $result->fetch_assoc()) {
				$title = $row['title'];
			}
			?>
			<h3>Add a review to the movie</h3>
			<form method = "GET" action="#">
				<fieldset>
					<legend>Reviews For "<?php echo "<b>$title</b>" ?>":</legend>
					<div>
						<label for="movie_list">Movie Title: </label>
						<select name="id" id="movie_list">
						<option value="<?php echo "$id" ?>"><?php echo "<b>$title</b>" ?></option>
						</select>
					</div>
					<div>
						<label>Rating:  </label>
						<input type="radio" name="rating" value="1">1
						<input type="radio" name="rating" value="2">2
			    		<input type="radio" name="rating" value="3">3
			    		<input type="radio" name="rating" value="4">4
			    		<input type="radio" name="rating" value="5">5
					</div>
					
					<div>
			    		<label for="comment">Comment: </label><br>
			    		<textarea name="comment" id="comment" cols="30" rows="10"></textarea>
					</div>

					<div>
						<label for="name">Your Name:</label><br>
						<input type="text" id="name" placeholder="Your name" name="name" value="Anonymous">
					</div>
				</fieldset>
				<button type="submit" class="btn btn-default">Submit</button>
		    </form>

		    <?php
		    //catch value from get 
		    if (!empty($_GET['name'])) {
		    	$name = $_GET['name'];
		    }
		    else {
		    	$err = true;
		    }

		    $time = date("Y:m:d H:i:s");

		    if (!empty($_GET['rating'])) {
		    	$rating = $_GET['rating'];
		    }
		    else {
		    	$err = true;
		    }

		    if (!empty($_GET['comment'])) {
		    	$comment = $_GET['comment'];
		    }
		    else {
		    	$err = true;
		    }
		    //insert tuples to Review table
		    if (!$err) {
			    $query = "INSERT INTO Review VALUES('$name','$time','$id','$rating','$comment')";
				$result = $db->query($query);
				if ($result === true) {
					echo "<p>Successfully added your comment, Thank you.</p>";
					echo "<p><a href=\"Show_Movie_Detail.php?id=$id\">Back to Movie Page</a></p>";
				} 
			}
		}
		$result->free();	
		$db->close();
	?>
</body>
</html>

