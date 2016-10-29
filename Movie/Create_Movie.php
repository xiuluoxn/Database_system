<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Movie</title>

</head>
<body>
	<h3>Add a movie</h3>
	<form method = "GET" action="#">
		<fieldset>
			<legend>Movie Info:</legend>
			
			<div>
				<label for="title">Movie title:</label><br>
				<input type="text" id="title" placeholder="title" name="title"><br>
				<label for="year">Year made:</label><br>
				<input type="text" id="year" placeholder="year" name="year">
			</div>
			<div>
				<label for="company">Company:</label><br>
				<input type="text" id="company" placeholder="company" name="company">
			</div>
			<div>
				<label>MPAA Rating:  </label>
				<input type="radio" name="rating" value="G">G
				<input type="radio" name="rating" value="PG">PG
	    		<input type="radio" name="rating" value="PG-13">PG-13
	    		<input type="radio" name="rating" value="R">R
	    		<input type="radio" name="rating" value="NC-17">NC-17
	    	</div>
			<div>
				<label for="genre">Genre:</label><br>
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Action">Action
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Adult">Adult
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Adventure">Adventure
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Animation">Animation
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Comedy">Comedy
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Crime">Crime
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Documentary">Documentary
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Drama">Drama
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Family">Family
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Fantasy">Fantasy
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Horror">Horror
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Musical">Musical
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Mystery">Mystery
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Sci-Fi">Sci-Fi
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Short">Short
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Thriller">Thriller
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="War">War
				<input type="checkbox" id="genre" placeholder="genre" name="genre[]" value="Western">Western
			</div>
		</fieldset>
		<button type="submit" class="btn btn-default">Submit</button>
    </form>
    

    <?php 
		// Create connection
		$db = new mysqli('localhost', 'cs143', '', 'CS143');
		// Check connection
		if($db->connect_errno > 0){
    		die('Unable to connect to database [' . $db->connect_error . ']');
		}
		// Check inputs
		if(!empty($_GET['title'])) {
			$title = htmlspecialchars($_GET['title']);
		}
		else {
			$error = true;
			//$error_msg = "title can not be empty \n";
		}

		if(!empty($_GET['year'])) {
			$year = htmlspecialchars($_GET['year']);
		}
		else {
			$error = true;
			//$error_msg = "year can not be empty \n";
		}

		if(!empty($_GET['rating'])) {
			$rating = $_GET['rating'];
		}
		else {
			$error = true;
			//$error_msg = "rating can not be empty \n";
		}

		if(!empty($_GET['company'])) {
			$company = htmlspecialchars($_GET['company']);
		}
		else {
			$error = true;
			////$error_msg = "company can not be empty \n";
		}

		if(!empty($_GET['genre'])) {
			$genre = $_GET['genre'];
		}
		else {
			$error = true;
			////$error_msg = "title can not be empty \n";
		}

		if(!$error) {
			//fetch and set valid id
			$query = "SELECT id FROM MaxMovieID;";
			$result = $db->query($query);
			$id = mysqli_fetch_assoc($result)['id'] + 1;
			$query = "INSERT INTO Movie VALUES ('$id', '$title', '$year', '$rating', '$company');";
			echo "$query";
			$result = $db->query($query);
			foreach ($genre as $value) {
			 	$query = "INSERT INTO MovieGenre VALUES ('$id','$value');";
			 	$result = $db->query($query);
			}
			if ($result === TRUE) {
			 	$query = "UPDATE MaxMovieID SET id = '$id';";
			 	$result = $db->query($query);
			 	?>
			 		<h3>Create Successfully!<h3>
				 	<p>
					 	The movie added:
					 	<ul>
						 	<li>Title: <?php echo "$title" ?></li>
						 	<li>Year: <?php echo "$year" ?></li>
						 	<li>Rating: <?php echo "$rating" ?></li>
						 	<li>Company: <?php echo "$company" ?></li>
						 	<li>Genre: <?php 
						 					foreach ($genre as $value) {
						 						echo "$value | ";
						 					} 
						 				?>
						 	</li>
					 	</ul>
				 	</p>
			 	<?php 
			}
			$result->free();
			$db->close();
		}
	?>
</body>
</html>