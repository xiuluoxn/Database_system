<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Show Movie Detail</title>
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
	        	?>

	        	<h2>Movie Infomation Page:</h2>

	        	<!-- Movie Basic Info -->
	        	<div>
	        		<h4>Movie Basic Info:</h4>
	        		<?php 
	        			//check id
	        			if (!empty($_GET['id'])) {
	        				$id = $_GET['id'];
	        			}
	        			else {
	        				$err = true;
	        			}
	        			if (!$err) {
	        				//Fetch the data of movie from the table Movie
	        				$query = "SELECT * FROM Movie WHERE id = '$id'";
	        				$result = $db->query($query);

	        				while($row = $result->fetch_assoc()) {
	        		    		echo "<div>";
	        		    		echo "<ul>";
	        	    			echo "<li><b>Title</b>:{$row['title']}</li>";
	        	    			echo "<li><b>Year</b>:{$row['year']}</li>";
	        	    			echo "<li><b>MPAA Rating</b>:{$row['rating']}</li>";  
	            				echo "<li><b>Producer</b>:{$row['company']}</li>";  
	        		    	}
	        		    	//Fetch the data of Director from the table MovieDirector
	        		    	$query = "SELECT CONCAT(first,' ',last) Name FROM Director D, MovieDirector MD WHERE mid = '$id' AND did = D.id";
	        				$result = $db->query($query);
	        				if ($result->num_rows == 0) {
	        					echo "<li><b>Director</b>:Unknown</li>";
	        				}
	        				echo "<li><b>Director(s)</b>:";
	        		    	while($row = $result->fetch_assoc()) {
	        	    			echo "{$row['Name']} | ";
	        		    	}
	        		    	echo "</li>";
	        				//Fetch the data of Genre from the table MovieGenre
	        		    	$query = "SELECT genre FROM MovieGenre WHERE mid = '$id'";
	        				$result = $db->query($query);
	        				if ($result->num_rows == 0) {
	        					echo "<li><b>Genre</b>:Unknown</li>";
	        				}
	        				else {
	        					echo "<li><b>Genre</b>:";
	        			    	while($row = $result->fetch_assoc()) {
	        		    			echo " {$row['genre']} |";

	        			    	}
	        			    	echo "</li>";
	        		    	}
	        		    	echo "</div>";
	        		    	echo "</ul>";
	        			}
	        		?>
	        	</div>

	        	<!-- Actor in the Movie Info -->
	        	<div>
	        		<h4>Actors/Actresses in the Movie:</h4>
	        		<?php 
	        			if (!$err) {
	        				//Fetch the data of movie from the table Movie
	        				$query = "SELECT id, CONCAT(first,' ',last) Name, role FROM Actor A, MovieActor MA WHERE mid = '$id' AND aid = id";
	        				$result = $db->query($query);
	        				?>
	        				<?php if ($result->num_rows > 0): ?>
	        					<table border="1" style="width:100%">
	        						<tr>
	        							<th>Name</th>
	        							<th>Role</th>
	        						</tr>
	        						<?php 
	        						while($row = $result->fetch_assoc()) {
	        							    		echo "<tr>";
	        						    			echo "<td><a href=\"Show_Actor_Detail.php?id={$row['id']}\">{$row['Name']}</a></td>";
	        						    			echo "<td>{$row['role']}</td>";  
	        						    			echo "</tr>";
	        							    	}
	        						?>
	        					</table>
	        				<?php else: ?>
	        					<p>No Record Found</p>
	        				<?php endif ?>
	        				<?php 
	        			}
	        		?>
	        	</div>
	        	<!-- Review for the Movie-->
	        	<div>
	        		<h4>Reviews for the Movie:</h4>
	        		<?php 
	        			if (!$err) {
	        				//Fetch the reviews of movie from the table Reviews
	        				$query = "SELECT name, time, rating, comment FROM Review WHERE mid = '$id';";
	        				$result = $db->query($query);
	        				?>
	        				<?php if ($result->num_rows > 0): ?>
	        					<!-- individual comment -->
	        					<div>
	        						<p>Comment detials shown below :</p>
	        						<table border="1" style="width:100%">
	        							<tr>
	        								<th>Comment By</th>
	        								<th>Create Time</th>
	        								<th>Rating</th>
	        								<th>Comment</th>
	        							</tr>
	        							<?php 
	        							while($row = $result->fetch_assoc()) {
	        								?>
	        								<tr>
	        							    	<td><?php echo "{$row['name']}" ?></td>
	        							    	<td><?php echo "{$row['time']}" ?></td>
	        							    	<td><?php echo "{$row['rating']}" ?></td>
	        							    	<td><?php echo "{$row['comment']}" ?></td>  
	        							    </tr>
	        							    <?php 
	        							}
	        							?>
	        						</table>
	        					</div>
	        					<?php 
	        						$query = "SELECT AVG(rating) average, COUNT(*) cont FROM Review WHERE mid = '$id';";
	        						$result = $db->query($query);
	        						if ($result->num_rows > 0) {
	        							while($row = $result->fetch_assoc()) {
	        								?>
	        								<!-- Average rating -->
	        								<div>
	        									<h5>The Average rating is: <?php echo "{$row['average']}" ?>/5--------From <?php echo "{$row['cont']}"?> reviews</h5>
	        								</div>
	        								<!-- link to create comment -->
	        								<div>
	        									<a href="Create_comments.php?id=<?php echo "$id" ?>">Leave your comments</a>
	        								</div>
	        								<?php 
	        							}
	        						}
	        					?>
	        				<?php else: ?>
	        					<!-- link to create comment -->
	        					<div>
	        						<a href="Create_comments.php?id=<?php echo "$id" ?>">Be the first one to comment on this movie: </a>
	        					</div>
	        				<?php endif ?>
	        				<?php 
	        			}
	        			
	        		?>
	        	</div>
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