<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create Movie</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/offcanvas.css" rel="stylesheet">
	<style>
    	.error {color: #FF0000;}
    </style>
</head>
<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <a class="navbar-brand" href="index.php">Movie Database System</a>
	    </div>
		<form class="navbar-form navbar-right" method = "GET" action="Search_Actor_Movie.php?<?php echo htmlspecialchars($_GET['search']) ?>">
            <input type="text" class="form-control" placeholder="Search..." name="name">
            <button type="submit">Search</button>
		</form>
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

	  <div class="row row-offcanvas row-offcanvas-right">

	    <div class="col-xs-12 col-sm-9">
	      <p class="pull-right visible-xs">
	        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
	      </p>
	      <div class="jumbotron">
	        <h2>Add a Movie</h2>
	        <h5><span class="error">* required field.</span></h5>
	        	<form method = "GET" action="#">
	        		<fieldset>
	        			<legend>Movie Info:</legend>
	        			
	        			<div>
	        				<span class="error">*</span><label for="title">Movie title:</label><br>
	        				<input type="text" id="title" placeholder="title" name="title"><br>
	        				<span class="error">*</span><label for="year">Year made:</label><br>
	        				<input type="text" id="year" placeholder="year" name="year">
	        			</div>
	        			<div>
	        				<span class="error">*</span><label for="company">Company:</label><br>
	        				<input type="text" id="company" placeholder="company" name="company">
	        			</div>
	        			<div>
	        				<span class="error">*</span><label>MPAA Rating:  </label>
	        				<input type="radio" name="rating" value="G">G
	        				<input type="radio" name="rating" value="PG">PG
	        	    		<input type="radio" name="rating" value="PG-13">PG-13
	        	    		<input type="radio" name="rating" value="R">R
	        	    		<input type="radio" name="rating" value="NC-17">NC-17
	        	    	</div>
	        			<div>
	        				<span class="error">*</span><label for="genre">Genre:</label><br>
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
	        		<p></p>
	        		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	            </form>
	            

	            <?php 
	            	$titleErr = $yearErr = $ratingErr = $companyErr = $genreErr ="";
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
	        			$err = true;
	        			$titleErr = "Title can not be empty";
	        		}

	        		if(!empty($_GET['year'])) {
	        			$year = htmlspecialchars($_GET['year']);
	        		}
	        		else {
	        			$err = true;
	        			$yearErr = "Year can not be empty";
	        		}

	        		if(!empty($_GET['rating'])) {
	        			$rating = htmlspecialchars($_GET['rating']);
	        		}
	        		else {
	        			$err = true;
	        			$ratingErr = "Rating must be selected";
	        		}

	        		if(!empty($_GET['company'])) {
	        			$company = htmlspecialchars($_GET['company']);
	        		}
	        		else {
	        			$err = true;
	        			$companyErr = "Company can not be empty";
	        		}

	        		if(!empty($_GET['genre'])) {
	        			$genre = htmlspecialchars($_GET['genre']);
	        		}
	        		else {
	        			$err = true;
	        			$genreErr = "Genre must be selected";
	        		}

	        		if (isset($_GET['submit'])) {
		        		if(!$err) {
		        			//fetch and set valid id
		        			$query = "SELECT id FROM MaxMovieID;";
		        			$result = $db->query($query);
		        			$id = mysqli_fetch_assoc($result)['id'] + 1;
		        			$query = "INSERT INTO Movie VALUES ('$id', '$title', '$year', '$rating', '$company');";
		        			$result = $db->query($query);
		        			foreach ($genre as $value) {
		        			 	$query = "INSERT INTO MovieGenre VALUES ('$id','$value');";
		        			 	$result = $db->query($query);
		        			}
		        			if ($result === TRUE) {
		        			 	$query = "UPDATE MaxMovieID SET id = '$id';";
		        			 	$result = $db->query($query);
		        			 	?>
		        			 		<h4 style="color: red">Create Movie Record Successfully!<h4>
		        			 	<?php 
		        			}
		        		}
		        		else {
		        			if (!empty($titleErr)) {
			        			echo "<h4 style=\"color: red\">Error! $titleErr!</h4>";
			        		}
			        		if (!empty($yearErr)) {
			        			echo "<h4 style=\"color: red\">Error! $yearErr!</h4>";
			        		}
			        		if (!empty($ratingErr)) {
			        			echo "<h4 style=\"color: red\">Error! $ratingErr!</h4>";
			        		}
			        		if (!empty($companyErr)) {
			        			echo "<h4 style=\"color: red\">Error! $companyErr!</h4>";
			        		}
			        		if (!empty($genreErr)) {
			        			echo "<h4 style=\"color: red\">Error! $genreErr!</h4>";
			        		}
		        		}
	        		}
	        	?>
	      </div>
	    </div><!--/.col-xs-12.col-sm-9-->

	    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	    	<div class="list-group">
	          <a href="Create_A_OR_D.php" class="list-group-item">Create Actor/Actress or director</a>
	          <a href="Create_Movie.php" class="list-group-item active">Create the records for a movie</a>
	          <a href="Actor_Movie.php" class="list-group-item">Assign an actor/actress to a movie</a>
	          <a href="Director_Movie.php" class="list-group-item">Assign an director to a movie</a>
	          <a href="Search_Actor_Movie.php" class="list-group-item">Search People/Movie</a>

	        </div>
	    </div><!--/.sidebar-offcanvas-->
	  </div><!--/row-->

	  <hr>

	  <footer>
	    <p>&copy; 2016 By Ning Xin, Aozhu Chen.</p>
	  </footer>

	</div><!--/.container-->
	<?php 
		// free the source
		$result->free();
		$db->close();
	?>
</body>
</html>