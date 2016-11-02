<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Comments</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/offcanvas.css" rel="stylesheet">
</head>
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
			<h2>Add a review to the movie</h2>
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
				<p></p>
				<button type="submit" class="btn btn-primary">Submit</button>
		    </form>

		    <?php
		    //catch value from get 
		    if (!empty($_GET['name'])) {
		    	$name = htmlspecialchars($_GET['name']);
		    }
		    else {
		    	$err = true;
		    }

		    if (!empty($_GET['rating'])) {
		    	$rating = htmlspecialchars($_GET['rating']);
		    }
		    else {
		    	$err = true;
		    }

		    if (!empty($_GET['comment'])) {
		    	$comment = htmlspecialchars($_GET['comment']);
		    }
		    else {
		    	$err = true;
		    }
		    //insert tuples to Review table
		    if (!$err) {
		    	$time = date("Y:m:d H:i:s");
			    $query = "INSERT INTO Review VALUES('$name','$time','$id','$rating','$comment')";
				$result = $db->query($query);
				if ($result === true) {
					echo "<p>Successfully added your comment, Thank you.</p>";
					echo "<p><a href=\"Show_Movie_Detail.php?id=$id\">Back to Movie Page</a></p>";
				} 
			}
		}
	?>
	      </div>
	    </div><!--/.col-xs-12.col-sm-9-->

	    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	    	<div class="list-group">
	          <a href="Create_A_OR_D.php" class="list-group-item">Create Actor/Actress or director</a>
	          <a href="Create_Movie.php" class="list-group-item">Create the records for a movie</a>
	          <a href="Actor_Movie.php" class="list-group-item">Assign an actor/actress to a movie</a>
	          <a href="Director_Movie.php" class="list-group-item">Assign an director to a movie</a>
	          <a href="Search_Actor_Movie.php" class="list-group-item active">Search People/Movie</a>

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

