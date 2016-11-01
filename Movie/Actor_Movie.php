<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Actor to Movie</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/offcanvas.css" rel="stylesheet">
</head>

<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <a class="navbar-brand" href="index.php">Movie Database System</a>
	    </div>

	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

	  <div class="row row-offcanvas row-offcanvas-right">

	    <div class="col-xs-12 col-sm-9">
	      <p class="pull-right visible-xs">
	        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
	      </p>
	      <div class="jumbotron">
	        <h2>Assign Actor to The Movie</h2>
	        <div>
	        	<form method="GET" action="#">
	        		<div>
	        			<label for="movie_list">Movie Title: </label><br>
	        			<select name="movie" id="movie_list" style="max-width:90%;">
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
	        		<p></p>
	        		<button type="submit" class="btn btn-primary">Submit</button>
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
	        </div>
	      </div>
	    </div><!--/.col-xs-12.col-sm-9-->

	    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	    	<div class="list-group">
	          <a href="Create_A_OR_D.php" class="list-group-item">Create Actor/Actress or director</a>
	          <a href="Create_Movie.php" class="list-group-item">Create the records for a movie</a>
	          <a href="Actor_Movie.php" class="list-group-item active">Assign an actor/actress to a movie</a>
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
</body>
</html>